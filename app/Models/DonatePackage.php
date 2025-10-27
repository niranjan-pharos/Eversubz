<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonatePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'donatepkg_id',
        'name',
        'email',
        'phone_number',
        'country',
        'message',
        'amount',
        'tip',
        'transaction_fee',
        'total_amount',
        'status',
        'donation_number',
        'anonymous',
        'payment_id',
    ];

    /**
     * Relationship: A donation belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
