<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'email', 'phone', 'description', 'tickets', 'total_amount', 'event_id','ticket_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function ticketItems()
    {
        return $this->hasMany(Ticket::class);
    }
    
}
