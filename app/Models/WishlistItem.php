<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'shoes_member_id',
        'product_id'
    ];

    public function shoesMember()
    {
        return $this->belongsTo(ShoesMember::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}