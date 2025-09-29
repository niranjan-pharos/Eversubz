<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreOrder extends Model
{ 
    protected $table = 'store_orders';
    protected $fillable = [
       'order_product_unique_id', 'seller_id', 'full_name', 'user_id','email', 'guest_email','phone_number', 'shipping_method','address', 'city', 'state', 'zip_code', 'country', 'total_amount', 'comments','payment_status', 'payment_id', 'status'
    ];

    public function items() 
    {
        return $this->hasMany(StoreOrderItem::class, 'store_order_id');
    }
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function histories()
    {
        return $this->hasMany(OrderStatusHistory::class, 'store_order_id');
    }

    public function business()
    {
        return $this->belongsTo(UserBusinessInfos::class, 'seller_id', 'id');
    }
    
}
