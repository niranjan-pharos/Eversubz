<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'fundraising_id',
        'user_id',
        'donation_number',
        'amount',
        'tip',
        'transaction_fee',
        'total_amount',
        'name',
        'email',
        'phone_number',
        'country',
        'message',
        'status',
        'payment_id',
        'anonymous',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fundraising()
    {
        return $this->belongsTo(Fundraising::class, 'fundraising_id');
    }
    
}