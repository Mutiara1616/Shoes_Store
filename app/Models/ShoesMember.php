<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ShoesMember extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class, 'shoes_member_id');
    }

    public function hasInWishlist($productId)
    {
        return $this->wishlistItems()->where('product_id', $productId)->exists();
    }
}