<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Models\Event;
use App\Models\User;
use App\Models\EventImage;  
use Illuminate\Support\Facades\DB; 
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\EventEnquiry;
use App\Models\Favorite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Booking;
use App\Models\Ticket;
use App\Models\EventTicketType;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\EventEnquiryMail;
use App\Mail\TicketEmail;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use Carbon\Carbon;


class EventsController extends Controller
{


    public function pricing()
    {
        return view('website.events.pricing');
    }

    public function index(Request $request)
    {
        $perPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION'));

        $categories = $request->query('categories', []);
        $cities = $request->query('cities', []);
        $mode = $request->query('mode');
        $search = $request->query('search');
        $filterDate = $request->query('filter_date'); 

        $currentDate = now();

        $eventsQuery = Event::select('id', 'title', 'host_name', 'slug', 'main_image', 'price', 'city', 'state', 'from_date_time', 'to_date_time')
            ->withCount(['users as interested_count' => function ($query) {
                $query->where('interested', true);
            }])
            ->withCount(['users as going_count' => function ($query) {
                $query->where('going', true);
            }])
            ->where('status', 1)
            ->where('to_date_time', '>', Carbon::now());

        if ($filterDate && strtolower($filterDate) !== 'all') {
            if (strtotime($filterDate) !== false) {
                $filterDateCarbon = \Carbon\Carbon::parse($filterDate);
 
                if ($filterDateCarbon->isToday()) {
                    $eventsQuery->whereDate('from_date_time', '=', $filterDateCarbon->toDateString());
                } elseif ($filterDateCarbon->isSameWeek($currentDate, \Carbon\Carbon::MONDAY)) {
                    $eventsQuery->whereBetween('from_date_time', [
                        $currentDate->startOfWeek(),
                        $currentDate->endOfWeek()
                    ]);
                } elseif ($filterDateCarbon->isWeekend()) {
                    $eventsQuery->whereBetween('from_date_time', [
                        $currentDate->next(\Carbon\Carbon::SATURDAY)->startOfDay(),
                        $currentDate->next(\Carbon\Carbon::SUNDAY)->endOfDay()
                    ]);
                } elseif ($filterDateCarbon->isNextWeek()) {
                    $eventsQuery->whereBetween('from_date_time', [
                        $currentDate->addWeek()->startOfWeek(),
                        $currentDate->addWeek()->endOfWeek()
                    ]);
                } else {
                    $eventsQuery->whereDate('from_date_time', '=', $filterDateCarbon->toDateString());
                }
            } else {
                \Log::warning('Unexpected filter_date value: ' . $filterDate);
            }
        }

        // Filter by categories
        if ($categories) {
            $eventsQuery->whereHas('category', function ($query) use ($categories) {
                $query->whereIn('slug', $categories);
            });
        }

        if ($cities) {
            $eventsQuery->whereIn('city', $cities);
        }

        if ($search) {
            $eventsQuery->where('title', 'like', '%' . $search . '%');
        }

        if ($mode) {
            if ($mode === 'free') {
                $eventsQuery->where(function ($query) {
                    $query->where('price', 0)
                        ->orWhere('price', '0.00')
                        ->orWhereNull('price');
                });
            } elseif ($mode === 'online' || $mode === 'offline') {
                $eventsQuery->where('mode', $mode);
            }
        } else {
            $eventsQuery->orderBy('id', 'desc');
        }

        $events = $eventsQuery->paginate($perPage)->withQueryString();
        

        $userEvents = Auth::check() ? Auth::user()->events->keyBy('id') : collect();

        $topCities = Event::select('city', DB::raw('count(*) as city_count'))
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->where('status', 1)
            ->where('to_date_time', '>', $currentDate) 
            ->groupBy('city')
            ->orderBy('city_count', 'desc')
            ->take(8)
            ->get();

        $categories = EventCategory::where('status', 1)
            ->withCount(['events as events_infos_count' => function ($query) {
                $query->where('status', 1);
            }])
            ->get();

        $topEvents = Event::where(['status' => 1, 'feature' => 1])
            ->orderBy('id', 'desc')
            ->where('to_date_time', '>', Carbon::now())
            ->take(10)
            ->get();

        return view('website.events.index', compact('events', 'topCities', 'categories', 'topEvents', 'userEvents'));
    }




    public function enquiry(Request $request)
    {
        try {
            Log::info('Form Submission Data:', $request->all());

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'description' => 'nullable|string|max:500',
                'slug' => 'required|string',
                'module' => 'required|string|in:event,business',
            ]);

            $module = $request->input('module');
            $slug = $request->input('slug');

            if ($module === 'event') {
                $entity = Event::where('slug', $slug)->firstOrFail();
            } elseif ($module === 'business') {
                $entity = Business::where('slug', $slug)->firstOrFail();
            } else {
                return response()->json(['success' => false, 'message' => 'Invalid module'], 400);
            }

            $author_email = $entity->user->email;
            $author_name = $entity->user->name;

            $enquiry = new Enquiry();
            $enquiry->name = $request->input('name');
            $enquiry->email = $request->input('email');
            $enquiry->phone = $request->input('phone');
            $enquiry->description = $request->input('description');
            $enquiry->module = $module;

            // Associate the enquiry with the entity (Event or Business)
            $enquiry->enquiryable()->associate($entity);
            $enquiry->save();

            $enquiry->author_name = $author_name;

            Mail::to($author_email)->send(new EventEnquiryMail($enquiry));

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error occurred during form submission:', ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'An error occurred while submitting the form.'], 500);
        }
    }


    public function updateCount(Request $request, $eventId)
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'You must be logged in'], 401);
        }

        $event = Event::find($eventId);

        if (!$event) {
            Log::error('Event not found', ['event_id' => $eventId]);
            return response()->json(['success' => false], 404);
        }

        $pivotData = $user->events()->where('event_id', $eventId)->first();

        Log::info('Pivot Data', ['pivotData' => $pivotData]);

        if ($request->type == 'interested') {
            if ($pivotData && $pivotData->pivot->interested) {
                $user->events()->updateExistingPivot($eventId, ['interested' => false]);
                $event->interested_count -= 1;
                Log::info('User marked uninterested', ['user_id' => $user->id, 'event_id' => $eventId]);
            } else {
                if ($pivotData) {
                    $user->events()->updateExistingPivot($eventId, ['interested' => true]);
                } else {
                    $user->events()->attach($eventId, ['interested' => true]);
                }
                $event->interested_count += 1;
                Log::info('User marked interested', ['user_id' => $user->id, 'event_id' => $eventId]);
            }
        } elseif ($request->type == 'going') {
            if ($pivotData && $pivotData->pivot->going) {
                $user->events()->updateExistingPivot($eventId, ['going' => false]);
                $event->going_count -= 1;
                Log::info('User marked not going', ['user_id' => $user->id, 'event_id' => $eventId]);
            } else {
                if ($pivotData) {
                    $user->events()->updateExistingPivot($eventId, ['going' => true]);
                } else {
                    $user->events()->attach($eventId, ['going' => true]);
                }
                $event->going_count += 1;
                Log::info('User marked going', ['user_id' => $user->id, 'event_id' => $eventId]);
            }
        }

        $event->save();

        Log::info('Event counts updated', ['interested_count' => $event->interested_count, 'going_count' => $event->going_count]);

        return response()->json([
            'success' => true,
            'interested_count' => $event->interested_count,
            'going_count' => $event->going_count
        ]);
    }


    //Event Deatils page

    public function events_details($slug)
    {
        $event = Event::with(['images', 'users', 'eventTags', 'user' => function($query) {
            $query->select('id', 'name', 'created_at'); 
        }])
        ->withCount([
            'users as interested_count' => function ($query) {
                $query->where('interested', true);
            },
            'users as going_count' => function ($query) {
                $query->where('going', true);
            }
        ])
        ->where('slug', $slug)
        ->firstOrFail();

        $event->formatted_from_date_time = Carbon::parse($event->from_date_time)->format('d M \\a\\t H:i');
        $event->formatted_to_date_time = Carbon::parse($event->to_date_time)->format('d M \\a\\t H:i');

        $user = $event->user;
        $userCreationDate = $user ? \Carbon\Carbon::parse($user->created_at)->format('M-Y') : null;

        $authUserInterested = Auth::check() ? $event->users()->where('user_id', Auth::id())->where('interested', true)->exists() : false;
        $authUserGoing = Auth::check() ? $event->users()->where('user_id', Auth::id())->where('going', true)->exists() : false;

        $isFavorite = Auth::check() ? Favorite::where('user_id', Auth::id())
                                            ->where('favoritable_type', Event::class)
                                            ->where('favoritable_id', $event->id)
                                            ->exists() : false;

        $organizedEventCount = $user ? Event::where('user_id', $user->id)->distinct('id')->count() : 0;
        $totalAdsCount = $user ? User::findOrFail($user->id)->adPosts()->count() : 0;
        $totalEvents = Event::where('user_id', $event->user_id)->count();

        $tickets = EventTicketType::where('event_id', $event->id)->get();

        return view('website.events.show', compact(
            'event', 
            'user', 
            'userCreationDate', 
            'authUserInterested', 
            'authUserGoing', 
            'isFavorite', 
            'organizedEventCount', 
            'totalAdsCount',
            'totalEvents',
            'tickets'
        ));
    }






    public function markInterested($id)
    {
        $event = Event::findOrFail($id);
        $event->users()->syncWithoutDetaching([Auth::id() => ['interested' => true]]);
        return response()->json(['status' => 'success', 'interested_count' => $event->users()->where('interested', true)->count()]);
    }

    public function unmarkInterested($id)
    {
        $event = Event::findOrFail($id);
        $event->users()->updateExistingPivot(Auth::id(), ['interested' => false]);
        return response()->json(['status' => 'success', 'interested_count' => $event->users()->where('interested', true)->count()]);
    }

    public function markGoing($id)
    {
        $event = Event::findOrFail($id);
        $event->users()->syncWithoutDetaching([Auth::id() => ['going' => true]]);
        return response()->json(['status' => 'success', 'going_count' => $event->users()->where('going', true)->count()]);
    }

    public function unmarkGoing($id)
    {
        $event = Event::findOrFail($id);
        $event->users()->updateExistingPivot(Auth::id(), ['going' => false]);
        return response()->json(['status' => 'success', 'going_count' => $event->users()->where('going', true)->count()]);
    }


    public function saveEvent(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'favoritable_type' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        $favoritableModel = app($request->favoritable_type); 
        $favoritable = $favoritableModel::where('slug', $request->slug)->firstOrFail();
        $favoritableId = $favoritable->id;

        $existingFavorite = Favorite::where('user_id', $user->id)
                                    ->where('favoritable_type', $request->favoritable_type)
                                    ->where('favoritable_id', $favoritableId)
                                    ->first();

        if ($existingFavorite) {
            $existingFavorite->delete();
            return response()->json(['message' => 'Removed from favorites.']);
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'favoritable_type' => $request->favoritable_type,
                'favoritable_id' => $favoritableId,
            ]);

            return response()->json(['message' => 'Added to favorites.']);
        }
    }


    public function addToCalendar(Request $request)
    {
        $user = Auth::user();

        // Validate the request data
        $request->validate([
            'event_id' => 'required|integer|exists:events,id',
        ]); 

        // Check if the event is already in the user's calendar
        $existingCalendarEvent = CalendarEvent::where('user_id', $user->id)
                                            ->where('event_id', $request->event_id)
                                            ->first();

        if ($existingCalendarEvent) {
            return response()->json(['message' => 'Event is already in your calendar.']);
        }

        // Add the event to the user's calendar
        CalendarEvent::create([
            'user_id' => $user->id,
            'event_id' => $request->event_id,
        ]);

        return response()->json(['message' => 'Event added to your calendar successfully.']);
    }


    public function remove(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'favoritable_type' => 'required|string|max:255',
            'favoritable_id' => 'required|integer',
        ]);

        Favorite::where('user_id', $user->id)
                ->where('favoritable_type', $request->favoritable_type)
                ->where('favoritable_id', $request->favoritable_id)
                ->delete();

        return response()->json(['message' => 'Item removed from favorites successfully.']);
    }



    public function addToPage(Request $request)
    {
        return response()->json(['message' => 'Item added to page successfully.']);
    }


    public function shareProfile(Request $request)
    {
        return response()->json(['message' => 'Profile shared successfully.']);
    }

    public function reportEvent(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'slug' => 'required|string',
            'reason' => 'required|string|max:255',
        ]);

        $event = Event::where('slug', $request->slug)->firstOrFail();
        $eventId = $event->id;

        EventReport::create([
            'user_id' => $user->id,
            'event_id' => $eventId,
            'reason' => $request->reason,
        ]);

        return response()->json(['message' => 'Event reported successfully.']);
    }
 

    // Booking
    public function bookTickets(Request $request)
    {

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'description' => 'string|nullable',
                'tickets' => 'required|integer|min:1',
                'slug' => 'required|string',
                'totalAmount' => 'required|numeric|min:0'
            ]);

            // Find the event by slug
            $event = Event::where('slug', $validated['slug'])->firstOrFail();

            // Check if enough tickets are available
            if ($validated['tickets'] > $event->available_tickets) {
                return response()->json(['success' => false, 'message' => 'Not enough tickets available'], 400);
            } 

            // Create a new booking
            $booking = Booking::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'description' => $validated['description'],
                'tickets' => $validated['tickets'],
                'total_amount' => $validated['totalAmount'],
                'event_id' => $event->id,
            ]);

            // Generate unique ticket identifiers
            for ($i = 0; $i < $validated['tickets']; $i++) {
                Ticket::create([
                    'booking_id' => $booking->id,
                    'ticket_id' => $this->generateTicketId(),
                ]);
            } 

            // Check if the total amount is 0 (free ticket)
            if ($validated['totalAmount'] == 0) {
                $pdf = $this->sendTicketMail($booking);
                return response()->json(['success' => true, 'message' => 'Ticket has been sent to your email.']);
            }
 
            // Create PayPal payment URL
            $paypalUrl = $this->createPayPalPayment($booking);

            return response()->json(['success' => true, 'paypal_url' => $paypalUrl]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation errors:', $e->errors());
            return response()->json(['success' => false, 'message' => 'Validation errors occurred', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error occurred while booking tickets:', ['message' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'An error occurred while booking tickets'], 500);
        }
    }


    private function createPayPalPayment($booking)
    {
        try {
            Log::info('Start creating PayPal payment', ['booking_id' => $booking->id]);

            // Create PayPal API context
            $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    config('paypal.client_id'), // ClientID
                    config('paypal.secret') // ClientSecret
                )
            );

            Log::info('API context created');

            // Create Payer object
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');
            Log::info('Payer created', ['payment_method' => $payer->getPaymentMethod()]);

            // Create Item object
            $item = new Item();
            $item->setName('Event Ticket')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice(number_format((float)$booking->total_amount, 2, '.', ''));
            Log::info('Item created', [
                'name' => $item->getName(),
                'currency' => $item->getCurrency(),
                'quantity' => $item->getQuantity(),
                'price' => $item->getPrice()
            ]);

            // Create ItemList object
            $itemList = new ItemList();
            $itemList->setItems([$item]);
            Log::info('ItemList created');

            // Create Amount object
            $amount = new Amount();
            $amount->setCurrency('USD')
                ->setTotal(number_format((float)$booking->total_amount, 2, '.', ''));
            Log::info('Amount created', [
                'currency' => $amount->getCurrency(),
                'total' => $amount->getTotal()
            ]);

            // Create Transaction object
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                        ->setItemList($itemList)
                        ->setDescription('Payment for event ticket')
                        ->setInvoiceNumber((string)$booking->id);
            Log::info('Transaction created');

            // Create RedirectUrls object
            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl(route('payment.status'))
                        ->setCancelUrl(route('payment.status'));
            Log::info('RedirectUrls created');

            // Create Payment object
            $payment = new Payment();
            $payment->setIntent('sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirectUrls)
                    ->setTransactions([$transaction]);
            Log::info('Payment object constructed', [
                'intent' => $payment->getIntent(),
                'payer' => $payment->getPayer()->getPaymentMethod(),
                'redirectUrls' => [
                    'return_url' => $payment->getRedirectUrls()->getReturnUrl(),
                    'cancel_url' => $payment->getRedirectUrls()->getCancelUrl()
                ],
                'transactions' => array_map(function($transaction) {
                    return [
                        'amount' => [
                            'currency' => $transaction->getAmount()->getCurrency(),
                            'total' => $transaction->getAmount()->getTotal()
                        ],
                        'itemList' => array_map(function($item) {
                            return [
                                'name' => $item->getName(),
                                'currency' => $item->getCurrency(),
                                'quantity' => $item->getQuantity(),
                                'price' => $item->getPrice()
                            ];
                        }, $transaction->getItemList()->getItems()),
                        'description' => $transaction->getDescription(),
                        'invoiceNumber' => $transaction->getInvoiceNumber()
                    ];
                }, $payment->getTransactions())
            ]);

            // Create PayPal payment
            $payment->create($apiContext);
            Log::info('PayPal payment created successfully');

            return $payment->getApprovalLink();
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            Log::error('PayPal error:', ['message' => $ex->getMessage(), 'data' => $ex->getData()]);
            throw new \Exception('Error creating PayPal payment');
        } catch (\Exception $e) {
            Log::error('General error:', ['message' => $e->getMessage()]);
            throw new \Exception('Error creating PayPal payment');
        }
    }



    public function getPaymentStatus(Request $request)
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );

        $paymentId = $request->paymentId;
        $payerId = $request->PayerID;

        if (empty($paymentId) || empty($payerId)) {
            return redirect()->route('home')->with('error', 'Payment was not successful.');
        }

        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $apiContext);
            if ($result->getState() == 'approved') {
                // Update booking status or perform necessary actions
                $bookingId = $payment->getTransactions()[0]->getInvoiceNumber();
                $booking = Booking::where('id', $bookingId)->first();
                if ($booking) {
                    $booking->update(['status' => 'paid']);
                    $this->sendTicketMail($booking);
                }

                return redirect()->route('home')->with('success', 'Payment success. Ticket has been sent to your email.');
            }
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            Log::error('PayPal error:', ['message' => $ex->getMessage()]);
            return redirect()->route('home')->with('error', 'Payment was not successful.');
        }

        return redirect()->route('home')->with('error', 'Payment was not successful.');
    }

    private function generateTicketId()
    {
        return strtoupper(Str::random(10));
    }

    public function sendTicketMail($booking)
    {
        $booking = Booking::select('id', 'name', 'email', 'phone', 'event_id')
            ->with([
                'ticketItems',
                'event' => function($query) {
                    $query->select('id', 'title', 'city', 'state', 'from_date_time', 'to_date_time', 'user_id')
                        ->with('creator:id,email');
                }
            ])
            ->find($booking->id);

        // Check if booking exists
        if (!$booking) {
            Log::error('Booking not found', ['booking_id' => $booking->id]);
            throw new \Exception('Booking not found');
        }

        $event = $booking->event;
        $eventCreatorEmail = $event->creator->email ?? null;

        // Clean and encode data
        $data = [
            'event' => [
                'title' => $this->logAndCleanField($event->title, 'Event Title'),
                'city' => $this->logAndCleanField($event->city, 'Event City'),
                'state' => $this->logAndCleanField($event->state, 'Event State'),
                'from_date_time' => $this->logAndCleanField($event->from_date_time, 'Event From DateTime'),
                'to_date_time' => $this->logAndCleanField($event->to_date_time, 'Event To DateTime')
            ],
            'booking' => [
                'name' => $this->logAndCleanField($booking->name, 'Booking Name'),
                'email' => $this->logAndCleanField($booking->email, 'Booking Email'),
                'phone' => $this->logAndCleanField($booking->phone, 'Booking Phone'),
                'ticketItems' => array_map(function ($ticket) {
                    return [
                        'ticket_id' => $this->logAndCleanField($ticket['ticket_id'], 'Ticket ID')
                    ];
                }, $booking->ticketItems->toArray())
            ]
        ];

        try {
            Mail::to($data['booking']['email'])->send(new TicketEmail($data));

            if ($eventCreatorEmail) {
                Mail::to($eventCreatorEmail)->send(new TicketEmail($data));
            }

            toastr()->success('Ticket has been sent to your email.');

            return response()->json(['message' => 'Ticket has been sent to your email.']);
        } catch (\Exception $e) {
            // Log error details and rethrow the exception
            Log::error('Error sending email', ['error' => $e->getMessage(), 'data' => $data]);
            throw $e;
        }
    }

    private function logAndCleanField($field, $fieldName)
    {
        if (is_null($field) || empty($field)) {
            Log::warning($fieldName . ' is empty or null.');
        }
        return htmlspecialchars(trim($field));
    }



    private function ensureUtf8($value, $fieldName)
    {
        Log::info("Ensuring UTF-8 encoding for field: $fieldName with value: $value");
        $encodedValue = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        if ($encodedValue !== $value) {
            Log::warning("Encoding issue detected in $fieldName. Original: [$value], Encoded: [$encodedValue]");
        }
        return $encodedValue;
    }

    private function cleanString($string)
    {
        return preg_replace('/[\x00-\x1F\x7F-\xA0\xAD\xC2\x80-\xC2\x9F]/u', '', $string);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'from_date_time' => 'required|date',
            'to_date_time' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:event_categories,id',
        ]);

        Event::create($request->all());

        return redirect()->route('frontend.events.index')->with('success', 'Event created successfully.');
    }


    public function eventCategory(){
        $categories = EventCategory::where('status', '1')
                        ->select('id', 'name AS text')
                        ->get();

        return response()->json(['categories' => $categories]);
    }

 
    /*
    public function show($slug)
    { 
        // Query the event by slug instead of ID
        $event = Event::with('images','user','eventTags')->where('slug', $slug)->firstOrFail();

        $totalAdsCount = User::findOrFail($event->user->id)->adPosts()->count();

        $totalEvents = Event::where('user_id', $event->user_id)->count();

        return view('website.events.show', compact('event','totalAdsCount','totalEvents'));
    }

    */
}
