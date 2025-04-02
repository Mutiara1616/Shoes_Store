<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $fillable = ['session_id', 'shoes_member_id'];
    
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
    
    public function shoesMember()
    {
        return $this->belongsTo(ShoesMember::class);
    }
    
    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            $price = $item->product->sale_price ?? $item->product->price;
            return $price * $item->quantity;
        });
    }
}