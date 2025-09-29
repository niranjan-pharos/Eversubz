<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderEventAttendee extends Model
{
    use HasFactory;

    protected $table = 'order_event_attendees';

    protected $fillable = [
        'event_id',
        'order_event_id',
        'ticket_type_id',
        'order_event_ticket_id',
        'attendee_fields', 
        'is_present'
    ];

    // Cast the attendee_fields column as an array
    protected $casts = [
        'attendee_fields' => 'array', // Automatically converts the column to array
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function orderEvent()
    {
        return $this->belongsTo(OrderEvent::class, 'order_event_id');
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }

    public function orderEventTicket()
    {
        return $this->belongsTo(OrderEventTicket::class, 'order_event_ticket_id');
    }
}
