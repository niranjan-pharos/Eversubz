<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventTag;
use App\Models\EventImage;
use App\Models\EventCategory; 
use App\Models\UserBusinessInfos;
use App\Models\AdPost;
use App\Models\OrderEvent;
use App\Models\OrderTicket;
use App\Models\OrderEventTicket;
use App\Models\Language;
use App\Models\BusinessProduct;
use App\Models\Enquiry;
use App\Models\TicketCategory;
use App\Models\Booking;
use App\Models\EventTicketType;
use App\Models\User;
use Intervention\Image\Facades\Image;
use App\Helper\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use HTMLPurifier;
use HTMLPurifier_Config;


class EventController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login')->with('error', 'You need to login first.');
        }
        
        $userId = Auth::id();

        $user = Auth::user();

        $perPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION'));

        $events = Event::with('category')
                    ->where('user_id', Auth::id()) 
                    ->orderBy('id', 'desc')
                    ->paginate($perPage);

        $totalAdPosts = AdPost::where('user_id', $userId)->count();

        $businessIds = UserBusinessInfos::where('user_id', $userId)->pluck('id');

        $totalBusinessProducts = BusinessProduct::whereIn('business_id', $businessIds)->count();

        $totalEvents = Event::where('user_id', $userId)->count();

        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 

        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug'); 

        return view('frontend.events.index', compact('events','totalAdPosts', 'totalBusinessProducts', 'totalEvents','is_approved','businessName'));
    }

 
    public function add()
    {
        $user = Auth::user();
        $account_type = $user->account_type;
        $userId = Auth::id();
        
        if ($user->is_admin_approved == 1 && $user->status == 'active') {
            $businessInfo = UserBusinessInfos::where('user_id', $user->id)->first();
            $hostName = $businessInfo ? $businessInfo->business_name : $user->name;
        } else {
            $hostName = $user->name;
        }

        $ticketCategories = TicketCategory::where('status', 1)
                        ->orderBy('name')
                        ->get(['id', 'name', 'slug']);


        $languages = Language::all()->filter(function ($language) {
            return !empty($language->name); 
        })->map(function ($language) {
            $language->name = strtolower($language->name); 
            return $language;
        })->unique('name'); 

        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 

        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');

        return view('frontend.events.create', compact('hostName','ticketCategories','is_approved','businessName','languages','account_type'));
    }
     

    public function store(Request $request)
    {
        if (!Auth::check()) {
            Log::warning('Store Event: Unauthorized access attempt.');
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'host_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'price' => 'nullable|numeric', 
            'event_description' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'from_date_time' => 'required|date_format:Y-m-d\TH:i',
            'to_date_time' => 'required|date_format:Y-m-d\TH:i|after:from_date_time',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'languages' => 'nullable|array',
            'languages.*' => 'string|max:255',
            'category_id' => 'required|exists:event_categories,id',
            'mode' => 'required|string|max:255',
            'ticket_type' => 'nullable|array',
            'ticket_type.*' => 'nullable|string|max:255',
            'ticket_price_adult.*' => 'nullable|numeric|min:0',
            'ticket_price_children.*' => 'nullable|numeric|min:0',
            'icon.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'max_quantity.*' => 'nullable|numeric|min:0',
        ]); 

        if ($validator->fails()) {
            Log::error('Store Event: Validation failed.', ['errors' => $validator->errors()]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Log::info('Store Event: Validation passed.', ['from_date_time' => $request->from_date_time]);

        $eventDescription = $request->input('event_description');
        if ($eventDescription) {
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);

            $eventDescription = $purifier->purify($eventDescription);
        }

        $mainImagePath = $request->file('main_image') ? $request->file('main_image')->store('event_images', 'public') : null;

        if ($mainImagePath) {
            try {
                Log::info('Store Event: Main image stored at ' . $mainImagePath);
                $thumbnailPath = 'event_images/thumb/' . basename($mainImagePath);

                $thumbnailImage = Image::make(storage_path('app/public/' . $mainImagePath))
                    ->resize(450, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
                Log::info('Store Event: Thumbnail created at ' . $thumbnailPath);
            } catch (\Exception $e) {
                Log::error('Store Event: Failed to create thumbnail.', ['error' => $e->getMessage()]);
            }
        }

        $user = Auth::user();
        $account_type = $user->account_type;

        try {
            $fromDateTime = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('from_date_time'))->format('Y-m-d H:i:s');
            $toDateTime   = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('to_date_time'))->format('Y-m-d H:i:s');

        } catch (\Exception $e) {
            Log::error('Store Event: Invalid date format provided.', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid date/time format provided.'], 422);
        }

        try {
            $event = Event::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'host_name' => $request->host_name,
                'charitable' => ($account_type == 3 ) ? 1 : 0,
                'about_host' => $request->about_host,
                'location' => $request->location,
                'city' => $request->city,
                'mode' => $request->mode,
                'state' => $request->state,
                'country' => $request->country,
                'price' => $request->price,
                'event_description' => $eventDescription,
                'facebook_link' => $request->facebook_link,
                'linkedin_link' => $request->linkedin_link,
                'x_link' => $request->x_link,
                'copy_event_url' => $request->copy_event_url,
                'refund_policy' => $request->refund_policy,
                'main_image' => $mainImagePath,
                'video_link' => $request->video_link,
                'from_date_time' => $fromDateTime,
                'to_date_time' => $toDateTime,
                'creatable_id' => Auth::id(),
                'creatable_type' => 'App\Models\User',
                'user_id' => Auth::id(),
                'status' => 0
            ]);

            Log::info('Store Event: Event created successfully. Event ID: ' . $event->id);
        } catch (\Exception $e) {
            Log::error('Store Event: Failed to create event.', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to create event.'], 500);
        }

        if ($request->has('languages')) {
            $languageNames = $request->languages;
            $languageIds = \App\Models\Language::whereIn('name', $languageNames)->pluck('id')->toArray();
            $event->languages()->sync($languageIds);
            Log::info('Store Event: Languages synced by names.', ['ids' => $languageIds]);
        }

        if ($request->has('tags')) {
            foreach ($request->tags as $tag) {
                EventTag::create([
                    'event_id' => $event->id,
                    'name' => $tag,
                ]);
            }
            Log::info('Store Event: Tags added.');
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('event_images', 'public');
                EventImage::create([
                    'event_id' => $event->id,
                    'image_path' => $imagePath
                ]);
            }
            Log::info('Store Event: Images added.');
        }

        if ($request->has('ticket_name')) {
            $uniqueTickets = [];
            foreach ($request->ticket_name as $index => $ticketName) {
                $ticketPrice = $request->ticket_price[$index] ?? 0;
                $ticketCategory = $request->ticket_type_category[$index] ?? '';
                $key = strtolower(trim($ticketName)) . '|' . $ticketPrice . '|' . $ticketCategory;
                if (!empty($ticketName) && !array_key_exists($key, $uniqueTickets)) {
                    $uniqueTickets[$key] = $index;
                }
            }
        
            foreach ($uniqueTickets as $key => $index) {
                $ticketName = $request->ticket_name[$index];
                $ticketPrice = $request->ticket_price[$index] ?? 0;
        
                $attendeeFields = [];
                if (!empty($request->attendee_info[$index])) {
                    foreach ($request->attendee_info[$index] as $fieldIndex => $fieldLabel) {
                        $attendeeFields[] = [
                            'label' => $fieldLabel,
                            'required' => !empty($request->attendee_required[$index][$fieldIndex])
                        ];
                    }
                }
        
                $iconPath = null;
                if ($request->hasFile("icon.$index")) {
                    $iconFile = $request->file("icon.$index");
                    $iconPath = $iconFile->store('ticket_icons', 'public');
                }
        
                $ticket = new EventTicketType([
                    'event_id' => $event->id,
                    'name' => $ticketName,
                    'ticket_type' => $request->ticket_type[$index] ?? null,
                    'category' => (int)($request->ticket_type_category[$index] ?? null),
                    'description' => $request->description[$index] ?? null,
                    'price' => $ticketPrice,
                    'is_free' => !empty($request->is_free_ticket[$index]),
                    'max_quantity' => $request->max_quantity[$index] ?? null,
                    'icon' => $iconPath,
                    'attendee_fields' => json_encode($attendeeFields),
                ]);
                $ticket->save();
            }
        }

        Log::info('Store Event: Function completed successfully.');
        return response()->json([
            'success' => 'Event created successfully.',
            'redirect_url' => '/user-events-list'
        ], 200);
    }



    public function edit($slug)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $event = Event::with(['ticketTypes', 'eventTags', 'images', 'languages'])
            ->where('slug', $slug)
            ->firstOrFail();

        foreach ($event->ticketTypes as $ticketType) {
            $ticketType->attendee_fields = $ticketType->attendee_fields
                ? json_decode($ticketType->attendee_fields, true)
                : [];
        }

        $allLanguages = Language::all()->filter(function ($language) {
            return !empty($language->name); 
        })->map(function ($language) {
            $language->name = strtolower($language->name); 
            return $language;
        })->unique('name'); 
        $selectedLanguages = $event->languages->pluck('id')->toArray();

        $selectedTags = $event->eventTags->pluck('name')->toArray();
        $categories = EventCategory::where('status', 1)->get(); 

        if ($event->user_id !== Auth::id()) {
            return response()->json(['error' => 'You are not authorized to edit this event'], 403);
        }

        $userId = Auth::id();
        $user = Auth::user();
        $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 
        $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug');

        return view('frontend.events.edit', compact(
            'event',
            'allLanguages',
            'selectedLanguages',
            'selectedTags',
            'categories',
            'is_approved',
            'businessName'
        ));
    }

    
    public function update(Request $request, $slug)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'host_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'available_tickets' => 'required|integer|min:0',
            'price' => ['nullable', 'regex:/^\d+(\.\d{1,2})?$/'],
            'event_description' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'from_date_time' => 'required|date',
            'to_date_time' => 'required|date|after:from_date_time',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'languages' => 'nullable|array',
            'languages.*' => 'integer|exists:languages,id',
            'category_id' => 'required|exists:event_categories,id',
            'mode' => 'required|string|max:255',
            'ticket_type' => 'nullable|array',
            'ticket_type.*' => 'nullable|string|max:255',
            'ticket_price_adult.*' => 'nullable|numeric|min:0',
            'ticket_price_children.*' => 'nullable|numeric|min:0',
            'max_quantity.*' => 'nullable|numeric|min:0',
            'icon.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'attendee_info' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $event = Event::where('slug', $slug)->firstOrFail();

        $eventDescription = $request->input('event_description');
        if ($eventDescription) {
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            $eventDescription = $purifier->purify($eventDescription);
        }

        $mainImagePath = $request->file('main_image') ? $request->file('main_image')->store('event_images', 'public') : $event->main_image;

        $user = Auth::user();

        $account_type = $user->account_type;

        $event->update([
            'category_id' => $request->category_id,
            'host_name' => $request->host_name,
            'about_host' => $request->about_host,
            'charitable' => ($account_type == 3 ) ? 1 : 0,
            'location' => $request->location,
            'city' => $request->city,
            'mode' => $request->mode,
            'state' => $request->state,
            'country' => $request->country,
            'price' => $request->price,
            'event_description' => $eventDescription, // Use sanitized description
            'facebook_link' => $request->facebook_link,
            'linkedin_link' => $request->linkedin_link,
            'x_link' => $request->x_link,
            'copy_event_url' => $request->copy_event_url,
            'refund_policy' => $request->refund_policy,
            'main_image' => $mainImagePath,
            'video_link' => $request->video_link,
            'available_tickets' => $request->available_tickets,
            'from_date_time' => $request->from_date_time,
            'to_date_time' => $request->to_date_time,
            'user_id' => Auth::id(),
            'attendee_info' => $request->attendee_info, 
        ]);

        if ($request->has('languages')) {
            $event->languages()->sync($request->languages);
        }

        if ($request->has('tags')) {
            $event->eventTags()->delete();
            foreach ($request->tags as $tag) {
                EventTag::create([
                    'event_id' => $event->id,
                    'name' => $tag,
                ]);
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('event_images', 'public');
                EventImage::create([
                    'event_id' => $event->id,
                    'image_path' => $imagePath
                ]);
            }
        }

        if ($request->has('ticket_name') && is_array($request->ticket_name) && count(array_filter($request->ticket_name))) {
            EventTicketType::where('event_id', $event->id)->delete();
            $uniqueTickets = [];
            $log = [];
            foreach ($request->ticket_name as $index => $ticketName) {
                $rawPrice = trim((string)($request->ticket_price[$index] ?? ''));
                $normalizedPrice = ($rawPrice === '' || $rawPrice === '0' || $rawPrice === '0.00') ? 0 : floatval($rawPrice);

                $ticketCategory = strtolower(trim((string)($request->ticket_type_category[$index] ?? '')));

                $key = strtolower(trim($ticketName)) . '|' . $normalizedPrice . '|' . $ticketCategory;

                $log[] = [
                    'index' => $index,
                    'ticketName' => $ticketName,
                    'rawPrice' => $rawPrice,
                    'normalizedPrice' => $normalizedPrice,
                    'ticketCategory' => $ticketCategory,
                    'dedupeKey' => $key,
                    'alreadyExists' => isset($uniqueTickets[$key]) ? 'YES' : 'NO'
                ];

                if (!empty($ticketName) && !array_key_exists($key, $uniqueTickets)) {
                    $uniqueTickets[$key] = $index;
                }
            }

            foreach ($uniqueTickets as $key => $index) {
                $ticketName = $request->ticket_name[$index];
                $rawPrice = trim((string)($request->ticket_price[$index] ?? ''));
                $normalizedPrice = ($rawPrice === '' || $rawPrice === '0' || $rawPrice === '0.00') ? 0 : floatval($rawPrice);

                $attendeeFields = [];
                if (!empty($request->attendee_info[$index])) {
                    foreach ($request->attendee_info[$index] as $fieldIndex => $fieldLabel) {
                        $attendeeFields[] = [
                            'label' => $fieldLabel,
                            'required' => !empty($request->attendee_required[$index][$fieldIndex])
                        ];
                    }
                }

                $iconPath = null;
                if ($request->hasFile("icon.$index")) {
                    $iconFile = $request->file("icon.$index");
                    $iconPath = $iconFile->store('ticket_icons', 'public');
                }

                $ticket = new EventTicketType([
                    'event_id'      => $event->id,
                    'name'          => $ticketName,
                    'ticket_type'   => $request->ticket_type[$index] ?? null,
                    'category'      => $request->ticket_type_category[$index] ?? null,
                    'description'   => $request->description[$index] ?? null,
                    'price'         => $normalizedPrice,
                    'is_free'       => $normalizedPrice == 0 ? 1 : 0,
                    'max_quantity'  => $request->max_quantity[$index] ?? null,
                    'icon'          => $iconPath,
                    'attendee_fields' => json_encode($attendeeFields),
                ]);
                $ticket->save();
            }
        }

        return response()->json(['success' => 'Event updated successfully!', 'redirect_url' => route('events.index')]);
    }

    
    public function deleteImage($id)
    {
        $image = EventImage::find($id);
    
        if (!$image) {
            return response()->json(['success' => false, 'message' => 'Image not found.'], 404);
        }
    
        // Delete the image file if needed
        if (Storage::exists($image->image_path)) {
            Storage::delete($image->image_path);
        }
    
        // Remove the record from the database
        $image->delete();
    
        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
    

    public function show($slug)
    { 
        $event = Event::with('images','user','eventTags')->where('slug', $slug)->firstOrFail();

        if (Auth::id() !== $event->user_id) {
            return redirect()->route('events.index')->with('error', 'Unauthorized access');
        }

        return view('frontend.events.show', compact('event'));
    }
 
    public function destroy($slug)
    {
        $event = Event::where('slug', $slug)->first();
    
        if ($event) {
            // Perform the deletion
            $event->delete();
    
            return response()->json(['success' => 'Event deleted successfully.']);
        }
    
        return response()->json(['error' => 'Event not found.'], 404);
    }
 
    
    public function showEventEnquiries(Request $request, $event_slug) {
        $event = Event::where('slug', $event_slug)->firstOrFail();
        
        $enquiries = Enquiry::with('enquiryable') // Load related event data
            ->where('enquiryable_id', $event->id) // Filter by event ID
            ->where('enquiryable_type', Event::class) // Ensure it's an event enquiry
            ->orderBy('created_at', 'desc')
            ->get();
            $userId = Auth::id();

            $user = Auth::user();
            $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 

            $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug'); 
        return view('frontend.events.event_specific_enquiries', compact('event', 'enquiries', 'is_approved', 'businessName'));
    }

    public function deleteEnquiry($id) {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();
        
        return response()->json(['success' => 'Enquiry deleted successfully.']);
    }

    
    public function bookingEvent(Request $request, $event_slug) {
        $event = Event::where('slug', $event_slug)->firstOrFail();
    
        $bookings = Booking::select('id', 'name', 'email', 'phone', 'event_id', 'description', 'tickets', 'created_at')
            ->where('event_id', $event->id)
            ->with([
                'event' => function($query) {
                    $query->select('id', 'title', 'price', 'from_date_time', 'to_date_time');
                }
            ])
            ->orderBy('created_at', 'desc') 
            ->get();
            $userId = Auth::id();

            $user = Auth::user();
            $is_approved = ($user->is_admin_approved == 1) ? 1 : 0; 

            $businessName = UserBusinessInfos::where('user_id', $userId)->value('slug'); 
        // Return the view with the event and its bookings
        return view('frontend.events.booking_event', compact('event', 'bookings',  'is_approved', 'businessName'));
    }

    public function deleteBooking($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->delete();

            return response()->json(['success' => true, 'message' => 'Booking deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Error occurred while deleting booking:', ['message' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the booking.'], 500);
        }
    }


    // For Buyer
    public function getUserTickets(Request $request)
    {
        $userId = Auth::id();
        $resultsPerPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION', 12)); 
        $sortBy = $request->query('sortBy', 'all'); 

        $ordersQuery = OrderEvent::where('user_id', $userId)
            ->where('status', 'completed')
            ->with([
                'event' => function ($query) {
                    $query->select('id', 'title', 'slug', 'host_name', 'mode', 'from_date_time', 'to_date_time', 'location', 'city', 'state', 'country');
                },
                'OrderEventTicket' => function ($query) {
                    $query->select('order_event_id', 'event_id','ticket_type_id', 'quantity', 'price', 'ticket_name', 'ticket_type', 'icon');
                }
            ])
            ->orderBy('id', 'desc'); // Orders sorted by ID in descending order

        if ($sortBy === 'upcoming') {
            $ordersQuery->whereHas('event', function ($query) {
                $query->where('from_date_time', '>=', Carbon::now());
            });
        } elseif ($sortBy === 'past') {
            $ordersQuery->whereHas('event', function ($query) {
                $query->where('to_date_time', '<', Carbon::now());
            });
        }

        $orders = $ordersQuery->paginate($resultsPerPage, ['id', 'event_id', 'first_name', 'last_name', 'total_amount', 'user_id', 'order_id']);

        $formattedOrders = $orders->map(function ($order) {
            return [
                'order_id' => $order->order_id,
                'name' => $order->first_name . ' ' . $order->last_name,
                'total_amount' => $order->total_amount,
                'event' => $order->event,
                'tickets' => $order->orderTickets,
            ];
        });

        return view('frontend.orders.myticketsorder', [
            'formattedOrders' => $formattedOrders,
            'resultsPerPage' => $resultsPerPage,
            'sortBy' => $sortBy,
            'paginationLinks' => $orders->links(),
        ]);
    }

    // For Seller for Ticket sell
    public function getSellerTickets(Request $request)
    {
        $userId = Auth::id(); // Current seller's user ID
        $resultsPerPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION', 12));
        $sortBy = $request->query('sortBy', 'all'); 
    
        $ordersQuery = OrderEvent::where('status', 'completed')
            ->whereHas('event', function ($query) use ($userId) {
                $query->where('user_id', $userId); // Event creator is the current seller
            })
            ->with([
                'event' => function ($query) {
                    $query->select('id', 'user_id', 'title', 'slug', 'host_name', 'mode', 'from_date_time', 'to_date_time', 'location', 'city', 'state', 'country');
                },
                'orderTickets' => function ($query) {
                    $query->select('order_event_id', 'ticket_type_id', 'quantity', 'price', 'ticket_name', 'ticket_type', 'icon');
                },
                'user:id,name,email,address,phone' // Eager load the full user data (adjust fields as needed)
            ])
            ->orderBy('id', 'desc'); 
    
        if ($sortBy === 'upcoming') {
            $ordersQuery->whereHas('event', function ($query) {
                $query->where('from_date_time', '>=', Carbon::now());
            });
        } elseif ($sortBy === 'past') {
            $ordersQuery->whereHas('event', function ($query) {
                $query->where('to_date_time', '<', Carbon::now());
            });
        }
    
        $orders = $ordersQuery->paginate($resultsPerPage, ['id', 'event_id', 'first_name', 'last_name', 'total_amount', 'user_id', 'payment_id', 'status']); // Include payment_status
    
        $formattedOrders = $orders->map(function ($order) {
            return [
                'order_id' => $order->id,
                'name' => $order->first_name . ' ' . $order->last_name,
                'total_amount' => $order->total_amount,
                'buyer_id' => $order->user_id, // User who bought the ticket
                'buyer_name' => $order->user ? $order->user->name : 'Guest', // The name of the user who purchased the ticket
                'buyer_email' => $order->user ? $order->user->email : 'N/A', // User email
                'buyer_address' => $order->user ? $order->user->address : 'N/A', // User address
                'buyer_phone' => $order->user ? $order->user->phone : 'N/A', // User phone
                'status' => $order->status, // Payment status
                'event_creator_id' => $order->event->user_id, // User who created the event
                'event' => $order->event,
                'tickets' => $order->orderTickets,
            ];
        });
        return view('frontend.orders.sellerTickets', [
            'formattedOrders' => $formattedOrders,
            'resultsPerPage' => $resultsPerPage,
            'sortBy' => $sortBy,
            'paginationLinks' => $orders->links(),
        ]);
    }
    
    

    public function viewOrderDetails($encryptedOrderId)
    {
        $orderId = Crypt::decryptString($encryptedOrderId);

        $order = OrderEvent::with(['event', 'orderTickets', 'user:id,name,email,address,phone']) 
                            ->where('id', $orderId)
                            ->firstOrFail();
        
        $this->authorize('markAttendeePresent', $order->event);

        $buyerData = null;
        if ($order->user_id) {
            $buyerData = $order->user;
        } elseif ($order->guest_email) {
            $buyerData = User::where('email', $order->guest_email)->first();
        }
        
        return view('frontend.orders.ticketorderdetails', [
            'order' => $order,
            'buyerData' => $buyerData,
        ]);
    }

    // buy event ticket listing
    public function myTickets(Request $request)
    {
        $user = auth()->user();

        $perPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION'));

        $orders = $user->orderEvents()
            ->with([
                'event',
                'orderTickets.ticketType',
                'orderTickets.attendees'
            ])
            ->orderByDesc('created_at')
            ->paginate($perPage);

        return view('frontend.events.purchase_events', compact('orders'));
    }

        
    // sell ticket lisitng
    public function myEventSales(Request $request)
    {
        $user = auth()->user();

        $perPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION'));

        $eventIds = \App\Models\Event::where('user_id', $user->id)->pluck('id');

        $orders = \App\Models\OrderEvent::whereIn('event_id', $eventIds)
            ->where('status', 'completed')
            ->with([
                'event',
                'orderTickets.ticketType',
                'orderTickets.attendees'
            ])
            ->orderByDesc('created_at')
            ->paginate($perPage);

        return view('frontend.events.sold_events', compact('orders'));
    }

    public function eventTickets(Request $request, $encryptedEventId)
    {
        $perPage = $request->query('perPage', config('constants.DEFAULT_PAGINATION'));

        $eventId = Crypt::decrypt($encryptedEventId);

        $user = auth()->user();

        $event = Event::where('id', $eventId)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $orderTickets = OrderEventTicket::with([
                'order',
                'attendees'
            ])
            ->where('event_id', $event->id)
            ->orderByDesc('created_at')
            ->paginate($perPage);

        return view('frontend.events.sold_events', compact('event', 'orderTickets'));
    }


}