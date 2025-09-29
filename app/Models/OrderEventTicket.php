<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderEventTicket extends Model
{ 
    use HasFactory; 

    protected $table = 'order_event_tickets';
 
    protected $fillable = [
        'order_event_id',
        'event_id',
        'ticket_type_id',
        'ticket_category_id',
        'ticket_name',
        'quantity',
        'price',
        'ticket_type',
        'icon',
        'hash'
    ];

    public function order()
    {
        return $this->belongsTo(OrderEvent::class, 'order_event_id');
    }

    public function ticketType()
    {
        return $this->belongsTo(EventTicketType::class, 'ticket_type_id');
    }

    public function ticket()
    { 
        return $this->belongsTo(Ticket::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function attendees()
    {
        return $this->hasMany(OrderEventAttendee::class, 'order_event_ticket_id');
    }
}
