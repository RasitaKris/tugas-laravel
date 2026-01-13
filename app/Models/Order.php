<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_service',
        'shipping_cost', 
        'payment_method',
        'payment_channel',
        'total',
        'status',
    ];


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
