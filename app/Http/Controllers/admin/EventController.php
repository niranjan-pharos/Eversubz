<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventTag;
use App\Models\EventImage;
use App\Models\Enquiry;
use App\Models\EventReport;
use App\Models\User;
use App\Models\Booking;
use App\Models\EventTicketType;
use App\Models\EventCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use HTMLPurifier;
use HTMLPurifier_Config;
use voku\helper\ASCII;
use voku\helper\UTF8;
use Image;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
 
 
class EventController extends Controller
{  
    public function index(){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Events',
                'url' => null
            ],
        ];
        return view('admin.events.index',compact('breadcrumbs'));
    }

    public function fetchTableData(){
        $result = ['data' => []]; 
    
        $events = Event::select('id', 'main_image', 'title', 'slug', 'host_name', 'status', 'location', 'from_date_time', 'to_date_time', 'user_id', 'feature','created_at','updated_at')
            ->with(['user:id,name'])
            ->orderBy('id', 'desc')
            ->get();
     
        foreach ($events as $key => $event) {
            $buttons = '';
            $feature = '';
    
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" onclick="viewFunc(' . $event->id . ')"><i class="fa fa-eye"></i></button>';
    
            $buttons .= '<button type="button" class="btn btn-default btn-sm icon-btn" onclick="removeFunc(\'' . $event->slug . '\')" ><i class="fa fa-trash"></i></button>';
    
            if ($event->status == 1) {
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$event->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked></div>';
            } else { 
                $status = '<div class="form-check form-switch">
                <input class="form-check-input change-status" data-id="'.$event->id.'" type="checkbox" role="switch" id="flexSwitchCheckChecked"></div>';
            }
    
            if ($event->feature == 1) {
                $feature = '<div class="form-check form-switch">
                <input class="form-check-input feature-status" data-id="'.$event->id.'" type="checkbox" role="switch" id="flexSwitchFeatureCheckChecked" checked></div>';
            } else { 
                $feature = '<div class="form-check form-switch">
                <input class="form-check-input feature-status" data-id="'.$event->id.'" type="checkbox" role="switch" id="flexSwitchFeatureCheckChecked"></div>';
            }
    
            $imagePath = $event->main_image ? asset('storage/' . $event->main_image) : asset('storage/no-image.jpg');
    
            $from_date_time = new DateTime($event->from_date_time);
            $to_date_time = new DateTime($event->to_date_time);
    
            $from_formattedDate = $from_date_time->format('D jS M Y, g:i a');
            $to_formattedDate = $to_date_time->format('D jS M Y, g:i a T');
    
            $dateTimeDisplay = $from_formattedDate . ' - ' . $to_formattedDate;
    
            $result['data'][$key] = [
                '<img src="' . $imagePath . '" alt="Event Image" class="img-thumbnail" style="width: 100px; height: 100px;">',
                $event->title,
                $event->user ? $event->user->name : '',
                $event->host_name,
                $event->location,
                $dateTimeDisplay,
                $feature,
                $status,
                optional($event->created_at)->format('d-m-Y'),
                optional($event->updated_at)->format('d-m-Y'),
                $buttons,
            ];
        }
    
        return response()->json($result);
    }
    
 

    public function add(){
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Events Add',
                'url' => null
            ],
        ];
        // $category = EventCategory::where('status', 1)
        // ->select('id', 'name', 'slug')
        // ->get();
        
        return view('admin.events.add_event',compact('breadcrumbs'));
    }

    public function store(Request $request)
    { 
        try {
            $request->validate([
                'from_date_time' => 'required|date_format:Y-m-d\TH:i|before_or_equal:to_date_time',
                'to_date_time' => 'required|date_format:Y-m-d\TH:i|after_or_equal:from_date_time',
                'title' => 'required|string|max:255',
                'user_id' => 'required|exists:users,id',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
                'tags' => 'nullable|array',
                'tags.*' => 'string|max:255',
                'ticket_type.*' => 'required|string|max:255',
                'ticket_price_adult.*' => 'required|numeric|min:0',
                'ticket_price_children.*' => 'required|numeric|min:0',
            ], [
                'user_id.required' => 'Please select a user to assign to this event.',
                'user_id.exists' => 'The selected user is invalid. Please try again.',
                'from_date_time.required' => 'Please provide the event start date and time.',
                'from_date_time.date_format' => 'The start date/time format is invalid.',
                'from_date_time.before_or_equal' => 'The start date/time must be before or equal to the end date/time.',
                
                'to_date_time.required' => 'Please provide the event end date and time.',
                'to_date_time.date_format' => 'The end date/time format is invalid.',
                'to_date_time.after_or_equal' => 'The end date/time must be after or equal to the start date/time.',
                
                'main_image.image' => 'The main image must be a valid image file.',
                'main_image.mimes' => 'The main image must be a file of type: jpeg, png, jpg, gif, svg, or webp.',
                'main_image.max' => 'The main image size must not exceed 1MB.',
                
                'ticket_type.*.required' => 'Please enter a ticket type (e.g. General, VIP).',
                'ticket_type.*.string' => 'Each ticket type must be a valid text.',
                'ticket_type.*.max' => 'Each ticket type must not exceed 255 characters.',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['status'=> 'false','message' => $e->validator->errors()->first()], 422);
        }
        

        $mainImagePath = null;
        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');

            if ($mainImage->getSize() > 1024 * 1024) {
                return response()->json([
                    'error' => 'The main image size should not exceed 1 MB.'
                ], 422);
            }

            $mainImagePath = $mainImage->store('event_images', 'public');

            $thumbnailPath = 'event_images/thumb/' . basename($mainImagePath);

            $thumbnailImage = Image::make(storage_path('app/public/' . $mainImagePath))
                ->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio(); 
                });

            Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
        }

        $eventDescription = $request->input('event_description');
        if ($eventDescription) {
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            $eventDescription = $purifier->purify($eventDescription);
        }
        if (!Auth::check()) {
            return response()->json(['error' => 'No authenticated user found'], 401);
        }

        $adminId = auth('admin')->id();
        $event = Event::create([
            'user_id' => $request->input('user_id'),
            'from_date_time' => $request->input('from_date_time'),
            'to_date_time' => $request->input('to_date_time'),
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title') . '-' . now()->timestamp),
            'host_name' => $request->input('host_name'),
            'about_host' => $request->input('about_host'),
            'location' => $request->input('location'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'price' => $request->input('price'),
            'video_link' => $request->input('video_link'),
            'event_description' => $request->input('event_description'),
            'facebook_link' => $request->input('facebook_link'),
            'linkedin_link' => $request->input('linkedin_link'),
            'x_link' => $request->input('x_link'),
            'copy_event_url' => $request->input('copy_event_url'),
            'refund_policy' => $request->input('refund_policy'),
            'main_image' => $mainImagePath,
            'orderby' => $request->input('orderby', 0),
            'feature' => $request->has('feature') ? 1 : 0,
            'charitable' => $request->has('charitable') ? 1 : 0,            
            'admin_id' => auth()->id()            
        ]);

        $ticketTypes = $request->input('ticket_type', []);
        $ticketPricesAdult = $request->input('ticket_price_adult', []);
        $ticketPricesChildren = $request->input('ticket_price_children', []);

        if (is_array($ticketTypes) && count($ticketTypes) > 0) {
            foreach ($ticketTypes as $index => $type) {
                if (!empty($type)) {
                    EventTicketType::create([
                        'event_id' => $event->id,
                        'ticket_type' => $type,
                        'ticket_price_adult' => $ticketPricesAdult[$index] ?? 0,
                        'ticket_price_children' => $ticketPricesChildren[$index] ?? 0,
                    ]);
                }
            }
        }


        if ($request->has('tags')) {
            foreach ($request->input('tags') as $tag) {
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
                    'image_path' => $imagePath,
                ]);
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Event created successfully!']);
    }


    public function show($id)
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Event List',
                'url' => route('adminEvents')
            ],
            [
                'label' => 'Details',
                'url' => null
            ],
        ];
        $event = Event::with(['eventTags', 'images','category'])->findOrFail($id);
        return view('admin.events.show', compact('event','breadcrumbs'));
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();

        $event = Event::where('id', $id)->where('created_by', $userId)->first();

        if (!$event) {
            return response()->json(['error' => 'Event not found.'], 404);
        }

        // Validate the request data
        $validated = $request->validate([
            'from_date_time' => 'required|date',
            'to_date_time' => 'required|date|after:from_date_time',
            'title' => 'required|string|max:255',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:255',
            // 'ticket_type.*' => 'required|string|max:255',
            // 'ticket_price_adult.*' => 'required|numeric|min:0',
            // 'ticket_price_children.*' => 'required|numeric|min:0',
            'host_name' => 'nullable|string|max:255',
            'about_host' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'video_link' => 'nullable|url',
            'event_description' => 'nullable|string',
            'facebook_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'x_link' => 'nullable|url',
            'copy_event_url' => 'nullable|url',
            'refund_policy' => 'nullable|string|max:255',
            'orderby' => 'integer',
            'feature' => 'boolean',
            'ticket_type' => 'nullable|array',
            'ticket_type.*' => 'nullable|string|max:255',
            'ticket_price_adult.*' => 'nullable|numeric|min:0',
            'ticket_price_children.*' => 'nullable|numeric|min:0',
            'icon.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'max_quantity.*' => 'nullable|numeric|min:0',
        ]);

        // Sanitize the event description using HTMLPurifier
        if ($request->has('event_description')) {
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            $validated['event_description'] = $purifier->purify($validated['event_description']);
        }

        // Regenerate the slug if the title has changed
        if ($event->title != $request->input('title')) {
            $slug = Str::slug($request->input('title'));  // Generate slug from the new title
            $slug = UTF8::to_ascii($slug);  // Transliterate to ASCII
            $event->slug = $slug . '-' . rand(1000, 9999);  // Add random number to ensure uniqueness
        }

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');

            if ($mainImage->getSize() > 1024 * 1024) {
                return response()->json([
                    'error' => 'The main image size should not exceed 1 MB.'
                ], 422);
            }

            // Delete old main image and thumbnail if they exist
            if ($event->main_image) {
                Storage::disk('public')->delete($event->main_image);
                $oldThumbnailPath = 'event_images/thumb/' . basename($event->main_image);
                Storage::disk('public')->delete($oldThumbnailPath);
            }

            // Store the new main image
            $mainImagePath = $mainImage->store('event_images', 'public');
            $event->main_image = $mainImagePath;

            // Create a thumbnail version of the main image
            $thumbnailPath = 'event_images/thumb/' . basename($mainImagePath);
            $thumbnailImage = Image::make(storage_path('app/public/' . $mainImagePath))
                ->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio(); // Maintain aspect ratio
                });

            Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
        }

        // Update other validated fields
        $event->update($validated);

        // Handle ticket types
        $ticketTypes = $request->input('ticket_type', []);
        // $ticketPricesAdult = $request->input('ticket_price_adult', []);
        // $ticketPricesChildren = $request->input('ticket_price_children', []);
        $ticketPrice = $request->input('ticket_price', []);
        $ticketCategory=$request->input('ticket_type_category',[]);
        $ticketName=$request->input('ticket_name',[]);
        $maxQuantity=$request->input('max_quantity',[]);
        $ticketDescription=input('ticket_description',[]);
        $freeTicket=input('is_free_ticket',[]);
        // Remove old ticket types
        $event->ticketTypes()->delete();

        // handle ticket icon

        $iconPath = null;
                if ($request->hasFile("icon.$index")) {
                    $iconFile = $request->file("icon.$index");
                    $iconPath = $iconFile->store('ticket_icons', 'public');
                }

        // Add new ticket types
        foreach ($ticketTypes as $index => $type) {
            if (!empty($type)) {
                TicketType::create([
                    'event_id' => $event->id,
                    'ticket_type' => $type,
                    'ticket_name'=>$ticketName,
                    'ticket_category'=>$ticketCategory,
                    'ticket_description'=>$ticketDescription,
                    'ticket_price'=>$ticketPrice,
                    'is_free_ticket'=>$freeTicket,
                    'max_quantity'=>$maxQuantity,
                    // 'ticket_price_adult' => $ticketPricesAdult[$index],
                    // 'ticket_price_children' => $ticketPricesChildren[$index],
                    'icon'=>$iconPath
                ]);
            }
        }

        // Handle tags
        if ($request->has('tags')) {
            // Remove old tags
            $event->tags()->delete();

            // Add new tags
            foreach ($request->input('tags') as $tag) {
                EventTag::create([
                    'event_id' => $event->id,
                    'name' => $tag,
                ]);
            }
        }

        // Handle multiple images
        if ($request->hasFile('images')) {
            // Delete old images
            foreach ($event->images as $oldImage) {
                Storage::disk('public')->delete($oldImage->image_path);
                $oldImage->delete();
            }

            // Store new images
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('event_images', 'public');
                EventImage::create([
                    'event_id' => $event->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Event updated successfully!']);
    }



    

    public function destroy($slug)
    {
        try {
           
 
            $event = Event::where('slug', $slug)->firstOrFail();

            // Delete main image if exists
            if ($event->main_image) {
                Storage::disk('public')->delete($event->main_image);
            }

            // Delete additional images
            foreach ($event->images as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }

            // Delete tags
            $event->eventTags()->delete();

            // Delete event
            $event->delete();

            return response()->json(['success' => true, 'messages' => 'Event deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => false, 'messages' => "Error deleting Event"]);
        }
    }


    // change status 
    function changeEventsStatus(Request $request){
        $update = [
            'status' => $request->status == 'true' ? 1 : 0
        ];
    
        Event::where('id', $request->id)->update($update);
    
        return response(['message' => 'Status changed']);
    }
    
    
    
    // change feature 
    function changeFeatureStatus(Request $request){
        Event::where('id', $request->id)->update([
            'feature' => $request->feature == 'true' ? 1 : 0
        ]);

        return response(['message' => 'Status changed']);
    }
    
   
    public function enquiries()
    {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Events',
                'url' => null
            ],
        ];
 
        return view('admin.events.event_enquiries', compact('breadcrumbs'));
    }

    // Retrieve event enquiries data for AJAX request
    public function getEventEnquiries()
    {
        $enquiries = Enquiry::with('enquiryable') // Load related event data
                            ->where('module', 'event') // Filter by module type 'event'
                            ->orderBy('created_at', 'desc')
                            ->get();
                            
        return response()->json($enquiries);
    }

    // Delete an enquiry
    public function deleteEnquiry($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();

        return response()->json(['success' => 'Enquiry deleted successfully.']);
    }


     public function reports() {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Reports',
                'url' => null
            ],
        ];

        return view('admin.events.events_report', compact('breadcrumbs'));
    }

    public function getEventReports() {
          $eventReports = EventReport::with(['event', 'user'])->orderBy('created_at', 'desc')->get();
        return response()->json($eventReports);
    }

    public function deleteReports($id) {
        $eventReport = EventReport::findOrFail($id);
        $eventReport->delete();

        return response()->json(['success' => 'Report deleted successfully.']);
    }

    // Tickets
    public function tickets() {
        $breadcrumbs = [
            [
                'label' => 'Dashboard',
                'url' => route('adminDashboard')
            ],
            [
                'label' => 'Event Tickets',
                'url' => null
            ],
        ];

        return view('admin.events.event_tickets', compact('breadcrumbs'));
    }

    public function getEventTickets() {
        $bookings = Booking::select('id', 'name', 'email', 'phone', 'event_id', 'description','created_at')
            ->with([
                'event' => function($query) {
                    $query->select('id', 'title', 'price','from_date_time', 'to_date_time');
                }
            ])
            ->orderBy('created_at', 'desc') 
            ->get();

        $data = $bookings->map(function ($booking) {
            return [
                'event_date' => $booking->event->from_date_time . ' - ' . $booking->event->to_date_time,
                'event_title' => $booking->event->title,
                'event_price' => $booking->event->price > 0 ? $booking->event->price : 'Free',
                'name' => $booking->name,
                'email' => $booking->email,
                'phone' => $booking->phone,
                'description' => $booking->description,
                'ticket_count' => $booking->ticketItems->count()
            ];
        });

        return response()->json(['data' => $data]);
    }

   
}
