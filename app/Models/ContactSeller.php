<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSeller extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'message', 'product_slug'];
}