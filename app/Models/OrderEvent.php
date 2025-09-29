<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderEvent extends Model
{
    use HasFactory;

    protected $table = 'order_events';

    protected $fillable = [ 
        'order_event_unique_id',
        'event_id',
        'user_id',
        'guest_email',
        'total_amount',
        'status',
        'payment_id',
        'coupon_code',
        'payment_method',
        'first_name',
        'last_name',
        'name',
        'email',
        'address',
        'receipt_number',
        'receipt_url',
        'card_fingerprint', 
        'card_last_four',
        'currency',
        'comments',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    } 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderTickets()  
    {
        return $this->hasMany(OrderEventTicket::class, 'order_event_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function attendees()
    {
        return $this->hasMany(OrderEventAttendee::class, 'order_event_id');
    }
}
