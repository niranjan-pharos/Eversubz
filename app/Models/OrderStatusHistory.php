<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    protected $fillable = [
        'store_order_id', 'store_order_item_id', 'changed_by_type', 'changed_by',
        'from_status', 'to_status', 'comment'
    ];

    public function order()
    {
        return $this->belongsTo(StoreOrder::class, 'store_order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
