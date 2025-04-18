<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {

        if (!Auth::guard('shoes')->check()) {
            return redirect()->route('shoes.login')->with('error', 'Please login to view your wishlist');
        }
        
        $user = Auth::guard('shoes')->user();
        $wishlistItems = $user->wishlistItems()->with('product')->get();
        
        return view('wishlist.index', compact('wishlistItems'));
    }
    
    public function add(Product $product)
    {
        $shoesMember = Auth::guard('shoes')->user();
        
        // Check if product is already in wishlist
        $existing = $shoesMember->wishlistItems()
            ->where('product_id', $product->id)
            ->first();
            
        if (!$existing) {
            $shoesMember->wishlistItems()->create([
                'product_id' => $product->id
            ]);
            
            return redirect()->back()->with('success', 'Product added to wishlist!');
        }
        
        return redirect()->back()->with('info', 'Product is already in your wishlist.');
    }
    
    public function remove(WishlistItem $wishlistItem)
    {
        // Check if wishlist item belongs to authenticated user
        if ($wishlistItem->shoes_member_id !== Auth::guard('shoes')->id()) {
            abort(403);
        }
        
        $wishlistItem->delete();
        
        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }
    
    public function moveToCart(WishlistItem $wishlistItem)
    {
        // Check if wishlist item belongs to authenticated user
        if ($wishlistItem->shoes_member_id !== Auth::guard('shoes')->id()) {
            abort(403);
        }
        
        $product = Product::findOrFail($wishlistItem->product_id);
        
        // Check if product has sizes or colors
        if ((is_array($product->sizes) && count($product->sizes) > 0) || 
            (is_array($product->colors) && count($product->colors) > 0)) {
            // If product requires size/color selection, redirect to product page
            return redirect()->route('products.show', $product->slug)
                ->with('info', 'Please select size and color options before adding to cart.');
        }
        
        // Add to cart only if product doesn't need size/color
        $cart = app(CartController::class)->getOrCreateCart();
        
        $cart->items()->create([
            'product_id' => $wishlistItem->product_id,
            'quantity' => 1,
        ]);
        
        // Remove from wishlist
        $wishlistItem->delete();
        
        return redirect()->route('cart.index')->with('success', 'Product moved to cart!');
    }
}