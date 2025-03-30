<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_number', 'shoes_member_id', 'status', 'total_amount',
        'shipping_address', 'shipping_city', 'shipping_state',
        'shipping_zipcode', 'shipping_phone', 'notes'
    ];

    public function shoesMember()
    {
        return $this->belongsTo(ShoesMember::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}