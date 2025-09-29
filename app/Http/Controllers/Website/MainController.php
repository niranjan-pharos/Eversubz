<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\AdPost;
use App\Models\Event;
use App\Models\EventReport;
use App\Models\UserBusinessInfos;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\BusinessCategory;
use App\Models\BusinessProduct;
use App\Models\EventCategory;
use App\Models\EventEnquiry;
use App\Models\Wishlist;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Booking;
use App\Models\Ticket;
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

class MainController extends Controller
{
    public function index(Request $request) 
    {
        $posts = AdPost::with(['category:id,slug','subcategory:id,slug,name', 
        'primaryImage'])
            ->where(['status' => 1])
            ->where('expiry_date', '>', now())
            ->orderBy('expiry_date', 'asc')
            ->take(6) 
            ->get();
            $posts->each(function ($post) {
                $post->isInWishlist = $post->wishlists->isNotEmpty();
            });

        $businesses = UserBusinessInfos::select('id', 'business_name', 'slug', 'logo_path', 'business_city', 'business_state', 'business_category')
            ->with(['businessCategory:id,name,slug'])
            ->where('status', 1)
            ->where('feature', 1)
            ->orderBy('orderby', 'asc')
            ->take(6)
            ->get();

        // Top Products
        $topProducts = BusinessProduct::select('id', 'title', 'slug', 'price', 'mrp', 'main_image', 'subcategory_id')
            ->with(['subcategory:id,slug,name'])
            ->where('business_products.feature', 1)
            ->where('business_products.status', 1) 
            ->orderBy('business_products.orderby')
            ->take(8)
            ->get();

            // events 

            $events = Event::select('id', 'title', 'host_name', 'slug', 'main_image', 'price', 'city', 'state', 'from_date_time')
            ->where('status', 1)
            ->orderBy('orderby')
            ->take(15)
            ->get();

             // Get the ad post counts grouped by city
             $topCities = AdPost::select('city', DB::raw('count(*) as total'))
             ->whereNotNull('city')
             ->where('city', '!=', '')
             ->groupBy('city')
             ->orderBy('total', 'desc')
             ->take(8)
             ->get();
             $featured = AdPost::where(['status'=> 1, 'featured' => 1])
             ->where('expiry_date', '>', now())
             ->with('tags', 'primaryImage', 'category', 'subcategory')
             ->withAvg('reviews as average_rating', 'rating')
             ->orderBy('expiry_date', 'asc')
             ->take(10)
             ->get();
        
              // Retrieve users ordered by the number of their AdPosts in descending order
        $users = User::select('users.*', DB::raw('COUNT(ad_posts.id) as ad_posts_count'))
        ->leftJoin('ad_posts', 'ad_posts.user_id', '=', 'users.id')
        ->groupBy('users.id')
        ->orderBy('ad_posts_count', 'desc')
        ->with('userDetails')
        ->take(6)

        ->get();
             
        return view('main.index', compact('posts','businesses','topProducts', 'events', 'topCities', 'featured', 'users'));
    }
 

    public function events_index(Request $request)
    {
        $perPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION'));
        $categories = $request->query('categories', []);
        $cities = $request->query('cities', []);
        $mode = $request->query('mode');
        $search = $request->query('search');

        $eventsQuery = Event::select('id', 'title', 'host_name', 'slug', 'main_image', 'price', 'city', 'state', 'from_date_time', 'from_date_time')
            ->withCount(['users as interested_count' => function ($query) {
                $query->where('interested', true);
            }])
            ->withCount(['users as going_count' => function ($query) {
                $query->where('going', true);
            }])
            ->where('status', 1);

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

        // Get user interested and going status if logged in
        $userEvents = Auth::check() ? Auth::user()->events->keyBy('id') : collect();

        $topCities = Event::select('city', DB::raw('count(*) as city_count'))
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->groupBy('city')
            ->orderBy('city_count', 'desc')
            ->take(8)
            ->get();

        $categories = EventCategory::where('status', 1)
            ->withCount(['events as events_infos_count' => function ($query) {
                $query->where('status', 1);
            }])
            ->get();

        // Fetch top 8 events with status = 1 and ordered by to_date_time descending
        $topEvents = Event::where(['status' => 1, 'feature' => 1])
            ->orderBy('orderby')
            ->take(10)
            ->get();

            

        return view('main.events_index', compact('events', 'topCities', 'categories', 'topEvents', 'userEvents'));
    }

    public function events_enquiry(Request $request){
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string|max:500',
        ]); 

        $event = Event::select('id','user_id')->with('user')->where('slug', $request->slug)->firstOrFail();
        
        $author_email = $event->user->email;
        $author_name = $event->user->name;

        // Create a new contact record using the Contact model
        $enquiry = EventEnquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
            'event_id' => $event->id,
        ]);

        $enquiry->author_name = $author_name;
                
        Mail::to($author_email)->send(new EventEnquiryMail($enquiry));

        return response()->json(['success' => true]);

    }


    public function updateCount(Request $request, $eventId)
    {
        $user = Auth::user();
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

        $user = $event->user;
        $userCreationDate = $user ? \Carbon\Carbon::parse($user->created_at)->format('M-Y') : null;

        $authUserInterested = Auth::check() ? $event->users()->where('user_id', Auth::id())->where('interested', true)->exists() : false;
        $authUserGoing = Auth::check() ? $event->users()->where('user_id', Auth::id())->where('going', true)->exists() : false;

        $isFavorite = Auth::check() ? Favorite::where('user_id', Auth::id())
                                            ->where('favoritable_type', Event::class)
                                            ->where('favoritable_id', $event->id)
                                            ->exists() : false;

        $organizedEventCount = Event::where('user_id', $user->id)->distinct('id')->count();

        return view('main.events_details', compact('event', 'user', 'userCreationDate', 'authUserInterested', 'authUserGoing', 'isFavorite', 'organizedEventCount'));
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


}