<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicketType extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'ticket_type',
        'category',
        'price',
        'is_free',
        'max_quantity',
        'sold_quantity',
        'status',
        'description',
        'icon',
        'attendee_fields',
        'day'
    ];

    protected $casts = [
        'attendee_fields' => 'array',
        'is_free' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function ticket_category()
    {
        return $this->belongsTo(TicketCategory::class, 'category');
    }
    
}
