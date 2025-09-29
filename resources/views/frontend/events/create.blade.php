@extends('frontend.template.master')
@section('title', 'Ad Event')

@section('content')
    @include('frontend.template.usermenu')
    @push('style')
        <link rel="stylesheet" href="{{ asset('admin_assets/css/select2.min.css') }}" async defer>
        <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css"
            rel="stylesheet" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.4/css/fileinput.min.css" async defer
            media="all" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <style>
            .note-editor .note-toolbar {
                font-size: 14px
            }

            .note-editor .note-btn {
                padding: 5px 10px
            }

            .note-editor .note-btn i {
                font-size: 12px
            }

            form .btn {
                padding: 10px 30px
            }

            .form-group label {
                font-weight: 700
            }

            textarea.form-control {
                height: 100px !important;
                padding: 15px 20px
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

            .ticket-row {
                border-bottom: 1px solid #ccc;
                padding: 20px 0px;
            }

            .form-control-lg1 {
                height: auto !important;
            }

            .card-body .btn {
                padding: 6px 5px 4px !important;
            }

            .card-body .btn i {
                margin-top: 0px;
                margin-right: 0px;
            }
        </style>
    @endpush

    <section class="inner-section category-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-card">
                        <div class="account-title">
                            <h3>Create Event</h3>
                        </div>
                        <form id="eventForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="title">Title<span>*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="category_id">Category<span>*</span></label>
                                        <select class="form-control custom-select" id="evt_category" name="category_id">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="mode">Mode</label>
                                        <select name="mode" id="mode" class="form-control">
                                            <option value="">--- Select Mode ---</option>
                                            <option value="online">Online</option>
                                            <option value="offline">Offline</option>
                                            <option value="this_weekend">This Weekend</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="host_name">Host Name<span>*</span></label>
                                        <input class="form-control" type="text" required name="host_name"
                                            value="{{ old('host_name', $hostName) }}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="host_name">About Host<span>*</span></label>
                                        <textarea rows="2" class="form-control" id="about_host" name="about_host" placeholder="About Host"></textarea>
                                    </div>
                                </div>



                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" id="location" name="location">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="city">City<span>*</span></label>
                                        <input type="text" class="form-control" id="city-input" name="city" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="state">State<span>*</span></label>
                                        <input type="text" class="form-control" id="state-input" name="state" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="country">Country<span>*</span></label>
                                        <input type="text" class="form-control" id="country-input" name="country"
                                            required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="event_description">Event Description</label>
                                        <textarea class="form-control" id="event_description" name="event_description"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Languages</label>
                                        <select class="form-control select2" id="languages" multiple="multiple"
                                            name="languages[]">
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->id }}">{{ ucfirst($language->name) }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Keywords</label>
                                        <select class="form-control select2" id="tags" multiple="multiple"
                                            name="tags[]">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="facebook_link">Facebook Link</label>
                                        <input type="url" class="form-control" id="facebook_link"
                                            name="facebook_link">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="linkedin_link">LinkedIn Link</label>
                                        <input type="url" class="form-control" id="linkedin_link"
                                            name="linkedin_link">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="x_link">X Link</label>
                                        <input type="url" class="form-control" id="x_link" name="x_link">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="copy_event_url">Copy Event URL</label>
                                        <input type="url" class="form-control" id="copy_event_url"
                                            name="copy_event_url">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="refund_policy">Refund Policy</label>
                                        <textarea class="form-control" id="refund_policy" name="refund_policy"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="from_date">From Date & Time</label>
                                        <input type="datetime-local" class="form-control" id="from_date"
                                            name="from_date_time">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="to_date">To Date & Time</label>
                                        <input type="datetime-local" class="form-control" id="to_date"
                                            name="to_date_time">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="main_image">Main Image</label>
                                        <input type="file" class="form-control" id="main_image" name="main_image">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="images">Additional Images</label>
                                        <input type="file" class="form-control" id="images" name="images[]"
                                            multiple>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <div id="ticketRows">
                                    </div>
                                    <button type="button" class="btn btn-success mt-3" id="addTicketBtn">Add Ticket
                                        Row</button>
                                </div>


                                <a href="{{ route('events.index') }}" class="btn btn-default mr-2">Back</a>
                                <button type="submit" id="btnSubmit" class="btn btn-inline">Create Event</button>
                                <div id="loaderAddEvent" class="spinner-border text-primary" role="status"
                                    style="display: none;">
                                    <span class="sr-only">Loading...</span>
                                </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{ asset('admin_assets/js/select2.full.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.4/js/fileinput.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChIWkQincZaqRjZrzfWxmFUPuR1YLvUCo&libraries=places&callback=initialize"
            async defer></script>
        <script>
            function initialize() {
                const cityInput = document.getElementById('city-input');
                const stateInput = document.getElementById('state-input');
                const countryInput = document.getElementById('country-input');

                const options = {
                    componentRestrictions: {
                        country: 'AU'
                    },
                    types: ['(cities)']
                };

                const autocomplete = new google.maps.places.Autocomplete(cityInput, options);

                autocomplete.addListener('place_changed', () => {
                    const place = autocomplete.getPlace();
                    if (!place.address_components) {
                        console.error('No address components found.');
                        return;
                    }

                    let city = '';
                    let state = '';
                    let country = '';

                    place.address_components.forEach(component => {
                        if (component.types.includes('locality')) {
                            city = component.long_name;
                        } else if (component.types.includes('administrative_area_level_1')) {
                            state = component.long_name;
                        } else if (component.types.includes('country')) {
                            country = component.long_name;
                        }
                    });

                    cityInput.value = city;
                    stateInput.value = state;
                    countryInput.value = country;

                });
            }
            
        </script>
        <script>
            window.ticketCategories = @json(
                $ticketCategories->map(function ($cat) {
                    return [
                        'id' => $cat->id,
                        'name' => $cat->name,
                        'slug' => $cat->slug
                    ];
                }));
        </script>
        <script>
            let ticketRowIndex = 0;

            function addTicketRow(ticketIndex = ticketRowIndex++) {
                const ticketRows = document.getElementById('ticketRows');
                const row = document.createElement('div');
                row.className = 'row form-row ticket-row align-items-center rounded border p-3 mb-4';

                row.innerHTML = `
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
                    ${getTicketCategoryOptions()}
                </select>
            </div>

                <div class="form-group col-md-4">
                    <label>Price</label>
                    <input type="number" class="form-control" name="ticket_price[]">
                </div>
                <div class="form-group col-md-4 d-flex align-items-center">
                    <input type="checkbox" name="is_free_ticket[]" id="is_free_ticket${ticketIndex}" value="1">&nbsp;
                    <label for="is_free_ticket${ticketIndex}" class="ms-2 mb-0"> Free Ticket</label>
                </div>
                <div class="form-group col-md-12">
                    <label>Ticket Description</label>
                    <textarea class="form-control" name="description[]"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label>Upload Icon</label>
                    <input type="file" class="form-control" name="icon[]">
                </div>
                <div class="form-group col-md-6 mt-4">
                    <input type="checkbox" id="add_attendee_info${ticketIndex}">
                    <label class="form-label">Do you want to add Attendee Info?</label>
                </div>
                <div id="attendeeInputs${ticketIndex}" class="col-md-12"></div>
            `;

                ticketRows.appendChild(row);

                const priceInput = row.querySelector('input[name="ticket_price[]"]');
                const freeCheckbox = row.querySelector(`#is_free_ticket${ticketIndex}`);
                freeCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        priceInput.value = "";
                        priceInput.disabled = true;
                    } else {
                        priceInput.disabled = false;
                    }
                });

                setupAttendeeInfoForTicket(ticketIndex);
            }

            function getTicketCategoryOptions() {
                if (!window.ticketCategories) return '';
                return window.ticketCategories.map(function(cat) {
                    return `<option value="${cat.id}">${cat.name}</option>`;
                }).join('');
            }


            function setupAttendeeInfoForTicket(ticketIndex) {
                let attendeeFields = [""];
                const maxAttendees = 4;

                document.getElementById('add_attendee_info' + ticketIndex).addEventListener('change', function() {
                    attendeeFields = [""];
                    renderAttendeeFields(ticketIndex);
                });

                function renderAttendeeFields(ticketIndex) {
                    const attendeeInputs = document.getElementById('attendeeInputs' + ticketIndex);

                    const previousValues = [];
                    attendeeInputs.querySelectorAll('input[type="text"]').forEach((input, idx) => {
                        previousValues[idx] = {
                            value: input.value,
                            required: input.required,
                            checked: input.parentNode.querySelector('input[type="checkbox"]').checked
                        };
                    });

                    attendeeInputs.innerHTML = '';

                    if (document.getElementById('add_attendee_info' + ticketIndex).checked) {
                        if (attendeeFields.length === 0) attendeeFields = [""];
                        attendeeFields.forEach((_, i) => {
                            attendeeInputs.appendChild(
                                createAttendeeField(
                                    i + 1,
                                    i === attendeeFields.length - 1 && attendeeFields.length < maxAttendees,
                                    ticketIndex,
                                    attendeeFields.length > 1,
                                    i
                                )
                            );
                        });

                        attendeeInputs.querySelectorAll('input[type="text"]').forEach((input, idx) => {
                            if (previousValues[idx]) {
                                input.value = previousValues[idx].value;
                                input.required = previousValues[idx].required;
                                const checkbox = input.parentNode.querySelector('input[type="checkbox"]');
                                if (checkbox) checkbox.checked = previousValues[idx].checked;
                            }
                        });
                    }
                }

                function createAttendeeField(number, showAddBtn, ticketIndex, showMinusBtn, idx) {
                    const wrapper = document.createElement('div');
                    wrapper.className = "d-flex align-items-center mb-4";

                    const input = document.createElement('input');
                    input.type = 'text';
                    input.className = "form-control form-control-lg me-3";
                    input.name = `attendee_info[${ticketIndex}][]`;
                    input.placeholder = "Column field name " + number;

                    const checkboxLabel = document.createElement('label');
                    checkboxLabel.className = "ms-2 m-2";
                    checkboxLabel.style.fontWeight = "normal";

                    const checkboxInput = document.createElement('input');
                    checkboxInput.type = "checkbox";
                    checkboxInput.className = "me-1 attendee-required-checkbox";
                    checkboxInput.name = `attendee_required[${ticketIndex}][]`;
                    checkboxInput.onchange = function() {
                        input.required = this.checked;
                    };

                    checkboxLabel.appendChild(document.createTextNode("   "));
                    checkboxLabel.appendChild(checkboxInput);
                    checkboxLabel.appendChild(document.createTextNode(" Required"));

                    wrapper.appendChild(input);
                    wrapper.appendChild(checkboxLabel);

                    if (showMinusBtn) {
                        const minusBtn = document.createElement('button');
                        minusBtn.type = 'button';
                        minusBtn.className = "btn btn-outline-danger btn-sm me-2";
                        minusBtn.innerHTML = '<i class="fas fa-minus"></i>';
                        minusBtn.onclick = function(e) {
                            e.preventDefault();
                            attendeeFields.splice(idx, 1);
                            renderAttendeeFields(ticketIndex);
                        };
                        wrapper.appendChild(minusBtn);
                    }

                    if (showAddBtn) {
                        const plusBtn = document.createElement('button');
                        plusBtn.type = 'button';
                        plusBtn.className = "btn btn-outline-primary btn btn-outline-primary btn-sm";
                        plusBtn.innerHTML = '<i class="fas fa-plus"></i>';
                        plusBtn.onclick = function(e) {
                            e.preventDefault();
                            if (attendeeFields.length < maxAttendees) {
                                attendeeFields.push("");
                                renderAttendeeFields(ticketIndex);
                            }
                        };
                        wrapper.appendChild(plusBtn);
                    }
                    return wrapper;
                }

                renderAttendeeFields(ticketIndex);
            }

            function prefillExistingTickets(tickets) {
                tickets.forEach((ticket, index) => {
                    addTicketRow(index);
                    const row = document.querySelectorAll('.ticket-row')[index];
                    row.querySelector('input[name="ticket_name[]"]').value = ticket.name;
                    row.querySelector('input[name="ticket_price[]"]').value = ticket.price;
                    row.querySelector('input[name="max_quantity[]"]').value = ticket.max_quantity;
                    row.querySelector('input[name="description[]"]').value = ticket.description;
                    row.querySelector('select[name="ticket_type[]"]').value = ticket.ticket_type;
                    row.querySelector('select[name="ticket_type_category[]"]').value = ticket.category;
                    if (ticket.is_free) {
                        row.querySelector('input[name="is_free_ticket[]"]').checked = true;
                    }

                    ticket.attendee_fields.forEach((field, attIndex) => {
                        const attendeeInputs = document.getElementById('attendeeInputs' + index);
                        const input = attendeeInputs.querySelectorAll('input[type="text"]')[attIndex];
                        const checkbox = attendeeInputs.querySelectorAll('input[type="checkbox"]')[attIndex];
                        if (input) input.value = field.label;
                        if (checkbox) checkbox.checked = field.required;
                    });
                });
            }

            document.getElementById('addTicketBtn').addEventListener('click', function() {
                addTicketRow(ticketRowIndex++);
                setTimeout(() => {
                    document.getElementById('addTicketBtn').scrollIntoView({
                        behavior: 'smooth'
                    });
                }, 0);
            });


            const tickets = @json($event->ticketTypes ?? []);
            prefillExistingTickets(tickets);
        </script>




        <script>
            $(document).ready(function() {
                $('#event_description').summernote({
                    height: 150
                });
                $('#about_host').summernote({
                    height: 100
                });




                var base_url = "{{ url('/') }}";
                $('#evt_category').each(function() {
                    $(this).select2({
                        dropdownParent: $(this).parent(),
                        placeholder: '--- Search Category ---',
                        allowClear: !0,
                        ajax: {
                            url: base_url + '/get-category',
                            type: "post",
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {
                                return {
                                    "_token": "{{ csrf_token() }}",
                                    searchTerm: params.term
                                }
                            },
                            processResults: function(data) {
                                return {
                                    results: data.categories
                                }
                            },
                            cache: !0
                        }
                    })
                });

                $('#eventForm').on('submit', function(e) {
                    e.preventDefault();

                    $("#btnSubmit").prop('disabled', true);
                    $("#loaderAddEvent").show();

                    let formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('events.create') }}',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            toastr.success(response.success);
                            $('#eventForm')[0].reset();
                            $("#btnSubmit").prop('disabled', false);
                            $("#loaderAddEvent").hide();

                            setTimeout(function() {
                                window.location.href = response.redirect_url;
                            }, 1500);
                        },
                        error: function(response) {
                            console.error(response);
                            if (response.status === 401) {
                                toastr.error('You need to login first.');
                            } else if (response.responseJSON && response.responseJSON.errors) {
                                let errors = response.responseJSON.errors;
                                for (let error in errors) {
                                    toastr.error(errors[error][0]);
                                }
                            } else {
                                toastr.error('An error occurred.');
                            }

                            $("#btnSubmit").prop('disabled', false);
                            $("#loaderAddEvent").hide();
                        }
                    });
                });


                $("#tags, #languages").select2({
                    tags: !0,
                    tokenSeparators: [',', ' ']
                });

                $('#accordion').on('shown.bs.collapse', function() {
                    $('html, body').animate({
                        scrollTop: $('#collapseOne').offset().top - 100
                    }, 500)
                });

                $(document).on('click', '.add-row', function() {
                    var newRow = $('.ticket-row:first').clone();
                    newRow.find('input').val('');
                    newRow.find('img').remove();
                    $('#ticketRows').append(newRow)
                });

                $(document).on('click', '.delete-row', function() {
                    if ($('.ticket-row').length > 1) {
                        $(this).closest('.ticket-row').remove()
                    } else {
                        toastr.warning('At least one ticket type is required.')
                    }
                });

                $('#eventForm input, #eventForm select').on('keypress', function(e) {
                    if (e.which == 13) {
                        e.preventDefault()
                    }
                });

            });
        </script>
    @endpush

@endsection
