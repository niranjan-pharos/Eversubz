<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreOrderItem extends Model
{
    protected $fillable = [
        'store_order_id', 'product_id', 'quantity', 'price', 'total',
        'seller_id', 'user_id', 'status'
    ];

    public function order()
    {
        return $this->belongsTo(StoreOrder::class, 'store_order_id');
    }

    public function product()
    {
        return $this->belongsTo(BusinessProduct::class);
    }

    public function seller()
    {
        return $this->belongsTo(UserBusinessInfos::class, 'seller_id');
    }

    public function userBusinessInfo()
    {
        return $this->belongsTo(UserBusinessInfos::class, 'user_id', 'user_id');
    }
}


