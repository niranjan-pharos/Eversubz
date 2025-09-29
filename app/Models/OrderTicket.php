<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'ticket_name',
        'ticket_type',
        'icon',
        'ticket_type_id',
        'ticket_id',
        'quantity',
        'price',
    ]; 

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function ticket()
    { 
        return $this->belongsTo(Ticket::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }

}
