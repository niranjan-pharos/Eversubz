@extends('frontend.template.master')
@section('title', 'Edit Event')

@section('content')
@include('frontend.template.usermenu')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://eversabz.com/admin_assets/css/select2.min.css" async defer>
<style>
form .btn {
    padding: 10px 30px
}

.note-editor .note-toolbar {
    font-size: 14px
}

.note-editor .note-btn {
    padding: 5px 10px
}

.note-editor .note-btn i {
    font-size: 12px
}

.form-group label {
    font-weight: 700
}

textarea.form-control {
    height: 100px !important;
    padding: 15px 20px
}

.form-group img {
    height: 75px;
    margin: 10px
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
    height: 40px;
    padding-top: 5px
}

.form-control {
    display: block;
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #000;
    height: 40px !important;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    box-shadow: none ! IMPORTANT;
    border: 1px solid #00000040 !important
}

.form-control:focus {
    border-color: #00b6f552 !important;
    outline: none;
    box-shadow: none;
    color: #fff;
    background: #fff;
    border-color: var(--primary)
}

.form-control:focus {
    color: #000 !important
}

.category-part .row:nth-child(2) {
    justify-content: normal;
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
    height: 40px;
    padding-top: 5px
}

.form-group .btn {
    padding: 3px 4px;
    font-size: 10px;
}

.ticket-row .form-group {
    margin-bottom: 15px
}

.ticket-row {    border-bottom: 1px solid #ccc;
    padding: 20px 0px;}

.form-control-lg1 {
    height: auto !important;
}

.card-body .btn {
    padding: 6px 5px 4px !important;
}

.card-body .btn i{
    margin-top: 0px;
    margin-right: 0px;
}
</style>
<section class="inner-section category-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h3>Edit Event</h3>
                    </div>
                    <form id="editEventForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="title">Title<span>*</span></label>
                                    <input type="text" class="form-control" id="title" value="{{ $event->title }}"
                                        disabled>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                        value="{{ $event->price }}">
                                </div>
                            </div> -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="mode">Mode</label>
                                    <select name="mode" id="mode" class="form-control">
                                        <option value="online" {{ $event->mode == 'online' ? 'selected' : '' }}>Online
                                        </option>
                                        <option value="offline" {{ $event->mode == 'offline' ? 'selected' : '' }}>
                                            Offline</option>
                                        <option value="this_weekend" {{ $event->mode == 'this_weekend' ? 'selected' : ''
                                            }}>This Weekend</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="host_name">Host Name<span>*</span></label>
                                    <input class="form-control" type="text" required name="host_name"
                                        value="{{ $event->host_name }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="category_id">Category<span>*</span></label>
                                    <select name="category_id" id="category_id" class="form-control select2">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $event->category_id ?
                                            'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location"
                                        value="{{ $event->location }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="city">City<span>*</span></label>
                                    <input type="text" class="form-control" id="city-input" name="city"
                                        value="{{ $event->city }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="state">State<span>*</span></label>
                                    <input type="text" class="form-control" id="state-input" name="state"
                                        value="{{ $event->state }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="country">Country<span>*</span></label>
                                    <input type="text" class="form-control" id="country-input" name="country"
                                        value="{{ $event->country }}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="event_description">Event Description</label>
                                    <textarea class="form-control" id="event_description"
                                        name="event_description">{{ $event->event_description }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-form-label">Languages</label>
                                    <select name="languages[]" class="form-control select2" multiple>
                                        @foreach ($allLanguages as $language)
                                            <option value="{{ $language->id }}" {{ in_array($language->id, $selectedLanguages) ? 'selected' : '' }}>
                                                {{ ucfirst($language->name) }}
                                            </option>
                                        @endforeach
                                    </select>                                                                        
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-form-label">Keywords</label>
                                    <select class="form-control add_multi_deals select2" id="tags" multiple="multiple"
                                        name="tags[]">
                                        @foreach ($selectedTags as $tag)
                                        <option value="{{ $tag }}" selected>{{ $tag }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="facebook_link">Facebook Link</label>
                                    <input type="url" class="form-control" id="facebook_link" name="facebook_link"
                                        value="{{ $event->facebook_link }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="linkedin_link">LinkedIn Link</label>
                                    <input type="url" class="form-control" id="linkedin_link" name="linkedin_link"
                                        value="{{ $event->linkedin_link }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="x_link">X Link</label>
                                    <input type="url" class="form-control" id="x_link" name="x_link"
                                        value="{{ $event->x_link }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="copy_event_url">Copy Event URL</label>
                                    <input type="url" class="form-control" id="copy_event_url" name="copy_event_url"
                                        value="{{ $event->copy_event_url }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="refund_policy">Refund Policy</label>
                                    <textarea class="form-control" id="refund_policy"
                                        name="refund_policy">{{ $event->refund_policy }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <!-- <div class="form-group">
                                    <label for="video_link">Video Link</label>
                                    <input type="url" class="form-control" id="video_link" name="video_link"
                                        value="{{ $event->video_link }}">
                                </div> -->
                                <div class="form-group">
                                    <label for="video_link">Want's to take all attendee info</label><br>
                                    <div>
                                        <input type="radio" id="attendee_yes" name="attendee_info" value="1"
                                            {{ $event->attendee_info == 1 ? 'checked' : '' }}>
                                        <label for="attendee_yes">Yes</label>

                                        <input type="radio" id="attendee_no" name="attendee_info" value="0"
                                            {{ $event->attendee_info == 0 ? 'checked' : '' }}>
                                        <label for="attendee_no">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="available_tickets">Available Tickets<span>*</span></label>
                                    <input type="number" required class="form-control" id="available_tickets"
                                        name="available_tickets" value="{{ $event->available_tickets }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="from_date">From Date & Time</label>
                                    <input type="datetime-local" class="form-control" id="from_date_time"
                                        name="from_date_time"
                                        value="{{ \Carbon\Carbon::parse($event->from_date_time)->format('Y-m-d\TH:i') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="to_date">To Date & Time</label>
                                    <input type="datetime-local" class="form-control" id="to_date_time"
                                        name="to_date_time"
                                        value="{{ \Carbon\Carbon::parse($event->to_date_time)->format('Y-m-d\TH:i') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="main_image">Main Image</label>
                                    <input type="file" class="form-control" id="main_image" name="main_image">
                                    @if ($event->main_image)
                                    <img loading="eager" src="{{ asset('storage/' . $event->main_image) }}"
                                        alt="{{ $event->title }}" class="preview-image">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="images">Additional Images</label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                                    <div class="row">
                                        @foreach ($event->images as $image)
                                        <div class="col-md-4 col-4 image-container">
                                            <!-- Added "image-container" class -->
                                            <img loading="eager" src="{{ asset('storage/' . $image->image_path) }}"
                                                alt="{{ $event->title }}" class="preview-image">
                                            <button type="button" class="btn btn-danger btn-sm delete-image-btn"
                                                data-image-id="{{ $image->id }}" data-type="extra">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="#FFFFFF">
                                                    </path>
                                                    <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19Z"
                                                        fill="#FFFFFF"></path>
                                                    <path
                                                        d="M14.99 12.29L14.285 11.58L10.99 14.875L9.69999 13.59L8.98999 14.295L10.99 16.29L14.99 12.29Z"
                                                        fill="#FFFFFF"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- Ticket --}}
                        <div id="accordion" class="mb-4">
                            <div class="">
                                <div class="" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" type="button"
                                            data-target="#collapseOne" aria-expanded="false"
                                            aria-controls="collapseOne">
                                            Edit Ticket Types
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div id="ticketRows">
                                            @if ($event->ticketTypes && $event->ticketTypes->count())
                                                @foreach ($event->ticketTypes as $ticketIndex => $ticket)
                                                    <div class="row form-row ticket-row align-items-center rounded border p-3 mb-4">
                                                        <div class="form-group col-md-3">
                                                            <label>Ticket Name</label>
                                                            <input type="text" class="form-control" name="ticket_name[]" value="{{ $ticket->name }}">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label>Ticket Type</label>
                                                            <select class="form-control" name="ticket_type[]">
                                                                <option value="adult" {{ $ticket->ticket_type == 'adult' ? 'selected' : '' }}>Adult</option>
                                                                <option value="children" {{ $ticket->ticket_type == 'children' ? 'selected' : '' }}>Children</option>
                                                                <option value="na" {{ $ticket->ticket_type == 'na' ? 'selected' : '' }}>N/A</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>Max Quantity</label>
                                                            <input type="number" class="form-control" name="max_quantity[]" value="{{ $ticket->max_quantity }}">
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label>Price</label>
                                                            <input type="number" class="form-control" name="ticket_price[]" value="{{ $ticket->price }}">
                                                        </div>
                                                        <div class="form-group col-md-2 d-flex align-items-center">
                                                            <input type="checkbox" name="is_free_ticket[]" id="is_free_ticket{{ $ticketIndex }}" value="1" {{ $ticket->is_free ? 'checked' : '' }}>
                                                            <label for="is_free_ticket{{ $ticketIndex }}" class="ms-2 mb-0">Free Ticket</label>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label>Ticket Category</label>
                                                            <select class="form-control" name="ticket_type_category[]">
                                                                <option value="regular" {{ $ticket->category == 'regular' ? 'selected' : '' }}>Regular</option>
                                                                <option value="early_bird" {{ $ticket->category == 'early_bird' ? 'selected' : '' }}>Early Bird</option>
                                                                <option value="vip" {{ $ticket->category == 'vip' ? 'selected' : '' }}>VIP</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Ticket Description</label>
                                                            <textarea class="form-control" name="description[]">{{ $ticket->description }}</textarea>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label>Upload Icon</label>
                                                            <input type="file" class="form-control" name="icon[]">
                                                            @if ($ticket->icon)
                                                                <div>
                                                                    <img src="{{ asset('storage/' . $ticket->icon) }}" alt="{{ $ticket->name }}" style="width: 50px; height: 50px;">
                                                                </div>
                                                            @endif
                                                        </div>
                                                        
                                                        <div class="form-group col-md-12 mt-2">
                                                            <label class="form-label">Add Attendee Info?</label>
                                                            <input type="checkbox" id="add_attendee_info{{ $ticketIndex }}" {{ count($ticket->attendee_fields) ? 'checked' : '' }}>
                                                        </div>
                                                        <div id="attendeeInputs{{ $ticketIndex }}" class="col-md-12">
                                                            @if(!empty($ticket->attendee_fields))
                                                                @foreach($ticket->attendee_fields as $attIndex => $attField)
                                                                    <div class="d-flex align-items-center mb-4">
                                                                        <input type="text" class="form-control form-control-lg me-3"
                                                                            name="attendee_info[{{ $ticketIndex }}][]"
                                                                            value="{{ $attField['label'] ?? '' }}"
                                                                            placeholder="Attendee Info {{ $attIndex + 1 }}">
                                                                        <label class="ms-2 mb-0" style="font-weight: normal;">
                                                                            <input type="checkbox"
                                                                                class="me-1 attendee-required-checkbox"
                                                                                name="attendee_required[{{ $ticketIndex }}][]"
                                                                                {{ !empty($attField['required']) ? 'checked' : '' }}>
                                                                            Required
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-2 d-flex justify-content-end">
                                                            <a href="javascript:void(0);" class="btn btn-outline-success add-row"><i class="fas fa-plus-circle"></i></a>
                                                            <a href="javascript:void(0);" class="btn btn-outline-danger delete-row"><i class="fas fa-minus-circle"></i></a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row form-row ticket-row align-items-center rounded border p-3 mb-4">
                                                    <div class="form-group col-md-3">
                                                        <label>Ticket Name</label>
                                                        <input type="text" class="form-control" name="ticket_name[]">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Ticket Type</label>
                                                        <select class="form-control" name="ticket_type[]">
                                                            <option value="adult">Adult</option>
                                                            <option value="children">Children</option>
                                                            <option value="na">N/A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label>Max Quantity</label>
                                                        <input type="number" class="form-control" name="max_quantity[]">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label>Price</label>
                                                        <input type="number" class="form-control" name="ticket_price[]">
                                                    </div>
                                                    <div class="form-group col-md-2 d-flex align-items-center">
                                                        <input type="checkbox" name="is_free_ticket[]" id="is_free_ticket0" value="1">
                                                        <label for="is_free_ticket0" class="ms-2 mb-0">Free Ticket</label>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Ticket Category</label>
                                                        <select class="form-control" name="ticket_type_category[]">
                                                            <option value="regular">Regular</option>
                                                            <option value="early_bird">Early Bird</option>
                                                            <option value="vip">VIP</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Ticket Description</label>
                                                        <textarea class="form-control" name="description[]"></textarea>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Upload Icon</label>
                                                        <input type="file" class="form-control" name="icon[]">
                                                    </div>
                                                    <div class="form-group col-md-12 mt-2">
                                                        <label class="form-label">Add Attendee Info?</label>
                                                        <input type="checkbox" id="add_attendee_info0">
                                                    </div>
                                                    <div id="attendeeInputs0" class="col-md-12"></div>
                                                    <div class="form-group col-md-2 d-flex justify-content-end">
                                                        <a href="javascript:void(0);" class="btn btn-outline-success add-row"><i class="fas fa-plus-circle"></i></a>
                                                        <a href="javascript:void(0);" class="btn btn-outline-danger delete-row"><i class="fas fa-minus-circle"></i></a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-success mt-3" id="addTicketBtn">Add Ticket Row</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('events.index') }}" class="btn btn-default">Back</a>
                        <button type="submit" id="btnSubmit" class="btn btn-inline">Update Event</button>
                        <div id="loaderEditEvent" class="spinner-border text-primary" role="status"
                            style="display: none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize">
</script>
<script>
    let ticketRowIndex = 0;

function addTicketRow(ticketIndex = ticketRowIndex++) {
    const ticketRows = document.getElementById('ticketRows');
    
    
    const row = document.createElement('div');
    row.className = 'row form-row ticket-row align-items-center rounded border p-3 mb-4';
    
    row.innerHTML = `
        <div class="form-group col-md-3">
            <label>Ticket Name</label>
            <input type="text" class="form-control" name="ticket_name[]">
        </div>
        <div class="form-group col-md-3">
            <label>Ticket Type</label>
            <select class="form-control" name="ticket_type[]">
                <option value="adult">Adult</option>
                <option value="children">Children</option>
                <option value="na">N/A</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label>Max Quantity</label>
            <input type="number" class="form-control" name="max_quantity[]">
        </div>
        <div class="form-group col-md-2">
            <label>Price</label>
            <input type="number" class="form-control" name="ticket_price[]">
        </div>
        <div class="form-group col-md-2 d-flex align-items-center">
            <input type="checkbox" name="is_free_ticket[]" id="is_free_ticket${ticketIndex}" value="1">
            <label for="is_free_ticket${ticketIndex}" class="ms-2 mb-0"> Free Ticket</label>
        </div>
        <div class="form-group col-md-3">
            <label>Ticket Category</label>
            <select class="form-control" name="ticket_type_category[]">
                <option value="regular">Regular</option>
                <option value="early_bird">Early Bird</option>
                <option value="vip">VIP</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>Ticket Description</label>
            <textarea class="form-control" name="description[]"></textarea>
        </div>
        <div class="form-group col-md-3">
            <label>Upload Icon</label>
            <input type="file" class="form-control" name="icon[]">
        </div>
        <div class="form-group col-md-12 mt-2">
            <label class="form-label">Add Attendee Info?</label>
            <input type="checkbox" id="add_attendee_info${ticketIndex}">
        </div>
        <div id="attendeeInputs${ticketIndex}" class="col-md-12"></div>
        <div class="form-group col-md-2 d-flex justify-content-end">
            <a href="javascript:void(0);" class="btn btn-outline-success add-row">
                <i class="fas fa-plus-circle"></i>
            </a>
            <a href="javascript:void(0);" class="btn btn-outline-danger delete-row">
                <i class="fas fa-minus-circle"></i>
            </a>
        </div>
    `;
    
    ticketRows.appendChild(row);

    
    setupAttendeeInfoForTicket(ticketIndex);

    
    initializeButtons(ticketIndex);
}

function setupAttendeeInfoForTicket(ticketIndex) {
    let attendeeCount = 0;
    const maxAttendees = 4;

    
    const addAttendeeCheckbox = document.getElementById('add_attendee_info' + ticketIndex);
    addAttendeeCheckbox.addEventListener('change', function() {
        console.log(`Checkbox clicked for ticket ${ticketIndex}, current value:`, this.checked);
        attendeeCount = 0;
        renderAttendeeFields(ticketIndex);
    });

    
    function renderAttendeeFields(ticketIndex) {
        const attendeeInputs = document.getElementById('attendeeInputs' + ticketIndex);
        attendeeInputs.innerHTML = ''; 

        if (document.getElementById('add_attendee_info' + ticketIndex).checked) {
            console.log(`Rendering attendee fields for ticket ${ticketIndex}`);
            for (let i = 1; i <= attendeeCount; i++) {
                attendeeInputs.appendChild(createAttendeeField(i, i === attendeeCount && attendeeCount < maxAttendees, ticketIndex));
            }
            if (attendeeCount === 0) {
                attendeeInputs.appendChild(createAttendeeField(1, true, ticketIndex));
                attendeeCount = 1;
            }
        }
    }

    
    function createAttendeeField(number, showAddBtn, ticketIndex) {
        const wrapper = document.createElement('div');
        wrapper.className = "d-flex align-items-center mb-4";

        const input = document.createElement('input');
        input.type = 'text';
        input.className = "form-control form-control-lg me-3";
        input.name = `attendee_info[${ticketIndex}][]`;
        input.placeholder = "Attendee Info " + number;

        const checkboxLabel = document.createElement('label');
        checkboxLabel.className = "ms-2 m-2";
        checkboxLabel.style.fontWeight = "normal";

        const checkboxInput = document.createElement('input');
        checkboxInput.type = "checkbox";
        checkboxInput.className = "me-1 attendee-required-checkbox";
        checkboxInput.name = `attendee_required[${ticketIndex}][]`;
        checkboxInput.onchange = function() { input.required = this.checked; };

        checkboxLabel.appendChild(document.createTextNode("   "));
        checkboxLabel.appendChild(checkboxInput);
        checkboxLabel.appendChild(document.createTextNode(" Required"));

        wrapper.appendChild(input);
        wrapper.appendChild(checkboxLabel);

        if (showAddBtn) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = "btn btn-outline-primary ms-3";
            btn.innerHTML = '<i class="fas fa-plus"></i>';
            btn.onclick = function(e) {
                e.preventDefault();
                if (attendeeCount < maxAttendees) {
                    attendeeCount++;
                    renderAttendeeFields(ticketIndex);
                }
            };
            wrapper.appendChild(btn);
        }
        return wrapper;
    }
}

function initializeButtons(ticketIndex) {
    const addRowBtn = document.querySelector(`#ticketRows .ticket-row:last-child .add-row`);
    const deleteRowBtn = document.querySelector(`#ticketRows .ticket-row:last-child .delete-row`);

    addRowBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const attendeeInputs = document.getElementById(`attendeeInputs${ticketIndex}`);
        attendeeInputs.appendChild(createAttendeeField(attendeeInputs.children.length + 1, true, ticketIndex));
    });

    deleteRowBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const attendeeInputs = document.getElementById(`attendeeInputs${ticketIndex}`);
        if (attendeeInputs.children.length > 1) {
            attendeeInputs.removeChild(attendeeInputs.lastChild);
        } else {
            toastr.warning('At least one attendee field is required.');
        }
    });
}

document.getElementById('addTicketBtn').addEventListener('click', function() {
    addTicketRow(ticketRowIndex++);
    setTimeout(() => {
        document.getElementById('addTicketBtn').scrollIntoView({ behavior: 'smooth' });
    }, 100);
});

document.getElementById('ticketRows').addEventListener('click', function(e) {
    if (e.target.closest('.delete-row')) {
        e.preventDefault();
        const ticketRow = e.target.closest('.ticket-row');
        if (document.querySelectorAll('#ticketRows .ticket-row').length > 1) {
            ticketRow.remove();
        } else {
            toastr.warning('At least one ticket is required.');
        }
    }
});


const tickets = @json($event->ticketTypes); 


</script>
<script>
    function initialize() {
        var cityInput = document.getElementById('city-input');
        var stateInput = document.getElementById('state-input');
        var countryInput = document.getElementById('country-input');
        var options = {
            componentRestrictions: {
                country: 'AU'
            },
            types: ['(cities)']
        };
        var autocomplete = new google.maps.places.Autocomplete(cityInput, options);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            var city = place.name;
            var state = '';
            var country = '';
            for (var i = 0; i < place.address_components.length; i++) {
                var component = place.address_components[i];
                if (component.types.includes('administrative_area_level_1')) {
                    state = component.long_name
                } else if (component.types.includes('country')) {
                    country = component.long_name
                }
            }
            cityInput.value = city;
            stateInput.value = state;
            countryInput.value = country
        });
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#category_id').select2({
            placeholder: '--- Search Category ---',
            allowClear: !0,
            ajax: {
                url: '{{ route('api.event-categories') }}',

                type: "POST",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data.categories, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    }
                },
                cache: !0
            }
        });
        $(".add_multi_deals, #languages").select2({
            tags: !0,
            tokenSeparators: [',', ' ']
        });
        $('#event_description').summernote({
            height: 150
        });
        $('#editEventForm input, #editEventForm select').on('keypress', function(e) {
            if (e.which == 13) {
                e.preventDefault()
            }
        });
        $('#accordion').on('shown.bs.collapse', function() {
            $('html, body').animate({
                scrollTop: $('#collapseOne').offset().top - 100
            }, 500)
        });

        $('#editEventForm').on('submit', function(e) {
            e.preventDefault();
            $("#loaderEditEvent").show();
            $("#btnSubmit").prop('disabled', true);
            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '{{ route('EventsUpdate', ['slug' => $event->slug]) }}',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.success);
                    $("#loaderEditEvent").hide();
                    $("#btnSubmit").prop('disabled', false);
                    setTimeout(function() {
                        window.location.href = response.redirect_url;
                    }, 1500);
                },
                error: function(response) {
                    if (response.status === 401) {
                        toastr.error('You need to login first.');
                    } else {
                        let errors = response.responseJSON.errors;
                        for (let error in errors) {
                            toastr.error(errors[error][0]);
                        }
                    }
                    $("#loaderEditEvent").hide();
                    $("#btnSubmit").prop('disabled', false);
                }
            });
        });

        $(document).on('click', '.delete-row', function() {
            if ($('.ticket-row').length > 1) {
                $(this).closest('.ticket-row').remove();
            } else {
                toastr.warning('At least one ticket type is required.');
            }
        });

    });



    $(document).on("click", ".delete-image-btn", function() {
        let button = $(this);
        let imageType = button.data("type");
        let imageId = button.data("image-id");

        if (confirm("Are you sure you want to remove this image?")) {
            if (imageType === "main") {
                alert("Main Image cannot be changed or deleted.");
            } else if (imageType === "extra") {
                $.ajax({
                    url: `/event/${imageId}/delete-image`,
                    method: "PATCH",
                    success: function(response) {
                        if (response.success) {
                            button.closest(".image-container").remove();
                            toastr.success(response.message || "Image removed successfully.");
                        } else {
                            toastr.error(response.message || "Failed to remove image.");
                        }
                    },
                    error: function() {
                        toastr.error("Failed to remove image. Please try again.");
                    },
                });
            }
        }
    });
</script>
@endsection