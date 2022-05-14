<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price', 'subtotal'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }


    public function scopeGetDetailByOrderid($query, $order_id)
    {
        return $query->where('order_id', $order_id);
    }

}
