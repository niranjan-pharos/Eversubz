@extends('frontend.template.master')
@section('title', 'Event Ticket - Successful')
@section('description', 'Event Ticket Buying Successful - Eversubz')
@section('content')
@php use SimpleSoftwareIO\QrCode\Facades\QrCode; @endphp
<style>
    .alert-success {
        background: transparent;
        color: #fff;
        text-align: center;
    }
    .alert-success h3 {
        font-size: 2.5rem;
        font-weight: 800;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 2;
        position: relative;
    }
    .alert-success p {
        font-size: 1.3rem;
        margin-top: 10px;
        z-index: 2;
        position: relative;
    }
    .order-summary {
        background: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        margin: 30px auto;
        color: #333;
        max-width: 800px;
        z-index: 2;
        position: relative;
    }

    .order-summary h3 {
        font-size: 2rem;
        color: #4caf50;
        margin-bottom: 20px;
        text-align: center;
    }

    .order-summary ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .order-summary li {
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eaeaea;
        padding-bottom: 10px;
    }

    .badge-success {
        background: linear-gradient(135deg, #28a745, #218838);
        color: #fff;
        padding: 6px 12px;
        font-size: 1rem;
        border-radius: 20px;
    }



    .thank-you-section {
        background: linear-gradient(135deg, #4caf50, #81c784);
        padding: 100px 20px;
        color: #fff;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .thank-you-section::before {
        content: "";
        position: absolute;
        top: -100px;
        right: -150px;
        background: rgba(255, 255, 255, 0.1);
        width: 400px;
        height: 400px;
        border-radius: 50%;
        z-index: 1;
        animation: pulse 8s infinite ease-in-out;
    }

    .thank-you-section::after {
        content: "";
        position: absolute;
        bottom: -150px;
        left: -150px;
        background: rgba(255, 255, 255, 0.1);
        width: 400px;
        height: 400px;
        border-radius: 50%;
        z-index: 1;
        animation: pulse 10s infinite ease-in-out;
    }
    .thank-you-actions a {
        background: linear-gradient(135deg, #4caf50, #81c784);
        color: #fff;
        padding: 15px 40px;
        border-radius: 30px;
        font-size: 1.2rem;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        transition: transform 0.3s ease, background 0.3s ease;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    }.thank-you-actions a:hover {
        transform: scale(1.1);
        background: linear-gradient(135deg, #388e3c, #66bb6a);
    }

    @media only screen and (max-width: 767px){
        
    .order-summary li {
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eaeaea;
        padding-bottom: 10px;    display: inline-block;
        max-width: 100%;
        word-wrap: break-word;
    }
    .thank-you-actions a{margin-bottom: 75px;}
    .alert-success h3 {
        font-size: 1.5rem;}
        .order-summary h3{font-size: 1.5rem;}
    }


    @media print {
        body * {
            visibility: hidden !important;
        }
        .thank-you-section, .thank-you-section * {
            visibility: visible !important;
        }
        .thank-you-section {
            position: absolute !important;
            left: 0; top: 0; width: 100%;
            background: white !important;
            color: #222 !important;
            z-index: 9999 !important;
            box-shadow: none !important;
        }
        .btn, .thank-you-actions, .alert, .text-right, .mt-2, .mb-3.text-right, .btn-outline-secondary {
            display: none !important;
        }
        
        .order-summary > .border {
            page-break-inside: avoid;
        }
        a[href]:after {
            content: "";
        }
    }
</style>

@php
    use Carbon\Carbon;
@endphp

<section class="py-5 thank-you-section">
    <div class="container">
        <div class="order-summary">
            <h2>Ticket Verified!</h2>
            <ul>
                <li><strong>Ticket:</strong> {{ $ticket->ticket_name }}</li>
                <li><strong>Event:</strong> {{ $ticket->event?->title ?? '-' }}</li>
                <li><strong>Type:</strong> {{ ucfirst($ticket->ticket_type ?? '-') }}</li>
                <li><strong>Quantity:</strong> {{ $ticket->quantity ?? '-' }}</li>
                @if(isset($from) && $from)
                <li>
                    <strong>From:</strong> {{ $from->format('F j, Y g:i A') }}<br>
                    @if(isset($to) && $to)
                        <strong>To:</strong> {{ $to->format('F j, Y g:i A') }}
                    @endif
                </li>
                @endif
                <li><strong>Status:</strong> {{ $eventStatus ?? '-' }}</li>
            </ul>
            <hr>
            <hr>
            <div class="mt-2 text-center">
                {!! QrCode::size(120)->generate(route('ticket.verify', ['hash' => $ticket->hash])) !!}
                <div class="text-muted">Qty: {{ $ticket->quantity }}</div>
            </div>
            <hr>

            @if($ticket->attendees && $ticket->attendees->count())
            <h4 class="mt-4">Attendee(s)</h4>
            <ul class="list-group">
                @foreach($ticket->attendees as $i => $attendee)
                    <li class="list-group-item mb-2">
                        <div class="mb-1"><b>Attendee #{{ $i + 1 }}</b></div>
                        @if(!empty($attendee->attendee_fields) && is_array($attendee->attendee_fields))
                            <ul class="mb-0 pl-3">
                                @foreach($attendee->attendee_fields as $field => $value)
                                    <li>
                                        <span class="font-weight-bold">{{ ucfirst(str_replace('_', ' ', $field)) }}:</span>
                                        {{ $value }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-muted">No details provided.</div>
                        @endif
                        
                        @can('markAttendeePresent', $attendee->orderEventTicket->event)
                            <!-- Check if the logged-in user is the event host -->
                            @if(auth()->check() && auth()->user()->id === $ticket->event->user_id)
                                <div>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                            class="custom-control-input mark-present-switch"
                                            id="mark-present-switch-{{ $attendee->id }}"
                                            data-attendee-id="{{ Crypt::encrypt($attendee->id) }}"
                                            {{ $attendee->is_present ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="mark-present-switch-{{ $attendee->id }}">
                                            Mark Present
                                        </label>
                                    </div>
                                </div>
                            @endif
                        @endcan
            
                        <span id="update-status-message" style="display:none; color:green;">Status Updated!</span>
            
                    </li>
                @endforeach
            </ul>
            
        @else
            <div class="alert alert-warning mt-3">No attendee info found for this ticket.</div>
        @endif


        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.mark-present-switch').forEach(function(switchEl) {
            switchEl.addEventListener('change', function () {
                const encryptedAttendeeId = this.getAttribute('data-attendee-id');
                fetch('{{ route("attendee.togglePresence") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        encrypted_attendee_id: encryptedAttendeeId,
                        is_present: this.checked ? 1 : 0
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success('Status updated successfully!');
                    } else {
                        toastr.error(data.message || 'Update failed!');
                    }
                });
            });
        });
    });

        
</script>
    

@endpush

@endsection