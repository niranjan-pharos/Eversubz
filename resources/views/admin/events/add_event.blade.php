@extends('admin.template.master')
@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css"
    rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<div class="search-lists">
    <div class="search-lists">
        <div class="tab-content">
            <div id="messages"></div>
            <div class="row">
                <div class="col float-right ml-auto">
                    <a href="{{ route('adminEvents')}}" class="btn btn-primary mb-3" style="float:right"><i
                            class="fa fa-mail-reply"></i> Events List </a>
                </div>
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <form  id="add_events" action="{{ route('adminEventsCreate') }}" enctype="multipart/form-data" method="post"
                                role="form">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">From Date & Time <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control " type="datetime-local" required
                                                    name="from_date_time" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">To Date & Time <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control " type="datetime-local" required
                                                    name="to_date_time" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Title <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" type="text" required name="title" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="category_id">Category<sup
                                                    class="text-danger">*</sup></label>
                                                <select class="form-control select2" id="evt_category" name="category_id">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Mode</label>
                                                <select name="mode" id="mode" class="form-control">
                                                    <option value="">--- Select Mode ---</option>
                                                    <option value="online">Online</option>
                                                    <option value="offline">Offline</option>
                                                    <option value="this_weekend">This Weekend</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Select User<sup
                                                    class="text-danger">*</sup></label>
                                                <select class="form-control select2 ajax_user" name="user_id">
                                        
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Host Name</label>
                                                <input class="form-control" type="text" name="host_name" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">About Host</label>
                                                <textarea rows="3" class="form-control" name="about_host"
                                                    placeholder="About Host"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Address</label>
                                                <input class="form-control" type="text" name="location">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">City:<sup
                                                        class="text-danger">*</sup></label>
                                                <input class="form-control" type="text" name="city" id="city-input">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">State</label>
                                                <input class="form-control" type="text" name="state" id="state-input">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Country</label>
                                                <input class="form-control" type="text" name="country"
                                                    id="country-input">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Video Link</label>
                                                <input class="form-control" type="text" name="video_link" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Event Description</label>
                                                <textarea class="form-control" id="adDescription"
                                                    placeholder="Describe your message" maxlength="1000"
                                                    name="event_description"
                                                    oninput="updateCharCount()">{{ old('event_description') }}</textarea>
                                                
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Facebook Link</label>
                                                <input class="form-control" type="text" name="facebook_link" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">LinkedIn Link</label>
                                                <input class="form-control" type="text" name="linkedin_link" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">X Link</label>
                                                <input class="form-control" type="text" name="x_link" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Copy Event URL</label>
                                                <input class="form-control" type="text" name="copy_event_url" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Refund Policy</label>
                                                <textarea rows="3" class="form-control" name="refund_policy"
                                                    placeholder="Refund Policy"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Keywords</label>
                                                <select class="form-control add_multi_deals select2" id="deals"
                                                    multiple="multiple" name="tags[]">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Main Image</label>
                                                <input type="file" class="form-control" id="main_image"
                                                    name="main_image">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">order by</label>
                                                <input type="number" id="orderby" name="orderby" class="form-control"
                                                    value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="col-form-label">Feature this event:</label><br />
                                                <input type="checkbox" id="feature" name="feature" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="col-form-label">Is Charitable:</label><br />
                                                <input type="checkbox" id="charitable" name="charitable" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Multiple Images</label>
                                                <input type="file" class="form-control" id="multiple_images"
                                                    name="images[]" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ticket Type Section -->
                                {{-- <div class="col-sm-12">
                                    <h4>Ticket Types</h4>
                                    <div id="ticketRows" >
                                        <div class="row form-row align-items-center ticket-row">
                                            <div class="form-group col-md-4">
                                                <input type="text" class="form-control" name="ticket_type[]" placeholder="Ticket Type" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <input type="text" class="form-control" name="ticket_price_adult[]" placeholder="Adult Price" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <input type="text" class="form-control" name="ticket_price_children[]" placeholder="Children Price" required>
                                            </div>
                                            <div class="form-group col-md-2 d-flex justify-content-start">
                                                <button type="button" class="btn btn-outline-success add-row"><i class="fas fa-plus-circle"></i></button>
                                                <button type="button" class="btn btn-outline-danger delete-row"><i class="fas fa-minus-circle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-sm-12">
                                    <h4>Ticket Types</h4>
                                    <div id="ticketRows">
                                        <div class="row form-row align-items-center ticket-row" data-ticket-index="0">
                                            <div class="form-group col-md-4">
                                                <label>Ticket Name</label>
                                                <input type="text" class="form-control" name="ticket_name[]">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Ticket Type</label>
                                                <select class="form-control" name="ticket_type[]">
                                                    <option value="adult">Adult</option>
                                                    <option value="children">Children</option>
                                                    <option value="na">N/A</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Max Quantity</label>
                                                <input type="number" class="form-control" name="max_quantity[]">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Ticket Category</label>
                                                <select class="form-control" name="ticket_type_category[]">
                                                    <!-- Replace with actual options or ensure getTicketCategoryOptions() is defined -->
                                                    <option value="general">General</option>
                                                    <option value="vip">VIP</option>
                                                    <option value="student">Student</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Price</label>
                                                <input type="number" class="form-control" name="ticket_price[]">
                                            </div>
                                            <div class="form-group col-md-4 d-flex align-items-center">
                                                <input type="checkbox" name="is_free_ticket[]" class="is-free-ticket" id="is_free_ticket_0" value="1">
                                                <label for="is_free_ticket_0" class="ms-2 mb-0"> Free Ticket</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Ticket Description</label>
                                                <textarea class="form-control" name="ticket_description[]"></textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Upload Icon</label>
                                                <input type="file" class="form-control" name="ticket_icon[]">
                                            </div>
                                            <div class="form-group col-md-6 mt-4">
                                                <input type="checkbox" class="add-attendee-checkbox" id="add_attendee_0" data-index="0">
                                                <label class="form-label ms-2">Do you want to add Attendee Info?</label>
                                            </div>
                                            <div id="attendeeInputs0" class="col-md-12 attendee-input-container"></div>
                                            <div class="form-group col-md-12">
                                                <button type="button" class="btn btn-outline-success add-ticket-row"><i class="fas fa-plus-circle"></i> Add Ticket</button>
                                                <button type="button" class="btn btn-outline-danger delete-ticket-row" style="display: none;"><i class="fas fa-minus-circle"></i> Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        {{-- end ticket --}}

                                <div class="submit-section">
                                    <button class="btn btn-primary submitBtn">Submit</button>
                                    <br>
                                </div>
                                <div id="loader" style="display: none;">
                                    <div class="spinner">Loading...</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js">
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize"
    async defer></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
let ticketIndex = 1;

$('#addTicketRow').click(function () {
    const newRow = $('.ticket-row:first').clone();

    
    newRow.find('input[type="text"], input[type="number"], input[type="datetime-local"]').val('');
    newRow.find('.add-attendee-checkbox').prop('checked', false);

    newRow.find('.add-attendee-checkbox')
        .attr('data-index', ticketIndex)
        .attr('id', 'add_attendee_' + ticketIndex);

    newRow.find('.form-check label[for^="add_attendee_"]').attr('for', 'add_attendee_' + ticketIndex);

    newRow.find('[id^="attendeeInputs"]').attr('id', 'attendeeInputs' + ticketIndex).hide();

    newRow.find('.remove-ticket-btn').show();

    $('#ticketSection').append(newRow);

    ticketIndex++;
});



$(document).on('click', '.delete-ticket-row', function () {
    $(this).closest('.ticket-row').remove();
});


$(document).on('change', '.add-attendee-checkbox', function () {
    const index = $(this).data('index');
    const isChecked = $(this).is(':checked');

    $('#attendeeInputs' + index).toggle(isChecked);
});

$(document).on('change', '.is-free-ticket', function () {
    const isChecked = $(this).is(':checked');
    const priceInput = $(this).closest('.ticket-row').find('input[name="ticket_price[]"]');
    priceInput.prop('disabled', isChecked);
});
</script>

<script>
        $(document).ready(function() {
            
            $('#adDescription').summernote({
                height: 150
            });

            $('.ajax_user').each(function() {
                $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: '--- Search User ---',
                allowClear: true,
                ajax: {
                    url:"{{route('ajaxSearchUser')}}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            "_token": "{{ csrf_token() }}",
                            searchTerm: params.term,
                        };
                    },
                    processResults: function(data) {
                        console.log(data);
                        return {
                            results: data,
                        };
                    },
                        cache: true
                    }
                });
            });
        

          $('#evt_category').each(function() {
            $(this).select2({
                dropdownParent: $(this).parent(),
                placeholder: '--- Search Category ---',
                allowClear: true,
                ajax: {
                    url: "{{ route('admin.getEventCategory') }}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            "_token": "{{ csrf_token() }}",
                            searchTerm: params.term
                        };
                    },
                    processResults: function(data) {
                        console.log('Data received:', data);
                        return {
                            results: data,
                        };
                    },
                    cache: true,
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX request failed:', textStatus, errorThrown);
                    }
                }
            });
        });

    });
   
    function initialize() {
        try {
         var cityInput = document.getElementById('city-input');
         var stateInput = document.getElementById('state-input');
         var countryInput = document.getElementById('country-input');
         var options = {
               componentRestrictions: {country: 'AU'},
               types: ['(cities)']
         };
         var autocomplete = new google.maps.places.Autocomplete(cityInput, options);
         autocomplete.addListener('place_changed', function() {
               var place = autocomplete.getPlace();
               console.log(place);
               var city = place.name;
               var state = '';
               var country = '';
               for (var i = 0; i < place.address_components.length; i++) {
                  var component = place.address_components[i];
                  if (component.types.includes('administrative_area_level_1')) {
                     state = component.long_name;
                  } else if (component.types.includes('country')) {
                     country = component.long_name;
                  }
               }
               cityInput.value = city;
               stateInput.value = state;
               countryInput.value = country;
         });
        } catch (error) {
            console.error('Error during initialization:', error.message);
        }
    }
    

    
    

    $(".add_multi_deals").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });


    $('#add_events').on('submit', function(e) {
        e.preventDefault();

        $('#submitBtn').attr('disabled', 'disabled');

        var formData = new FormData(this);
        $.ajax({
            url: "{{ route('adminEventsCreate') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(response) {
                toastr.success(response.message);
                $('#add_events')[0].reset(); 
                $('.select2').val(null).trigger('change'); 
                adDescription.summernote('reset'); 
                updateCharCount(); 
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.error(value);
                    });
                } else {
                    toastr.error('An unexpected error occurred. Please try again.');
                }
            },
            complete: function() {
                $('#loader').hide();
                $('#submitBtn').removeAttr('disabled');
            }
        });
    });

</script>
<style>
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
    height: 40px;

    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    border: 1px solid #00000040 !important;

}

.form-control:focus {
    outline: none;
    box-shadow: none;
    background: #fff;
    border-color: var(--primary);
}

.col-form-label {
    color: #000;
}
</style>

@endsection