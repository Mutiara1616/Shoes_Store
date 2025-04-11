<?php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getOrCreateCart()
    {
        // Jika user login, prioritaskan cart berdasarkan user ID
        if (Auth::guard('shoes')->check()) {
            $cart = Cart::where('shoes_member_id', Auth::guard('shoes')->id())
                ->first();
            
            if ($cart) return $cart;
        }

        // Gunakan session ID
        $sessionId = session()->get('cart_session_id');

        if (!$sessionId) {
            $sessionId = Str::uuid();
            session()->put('cart_session_id', $sessionId);
        }

        return Cart::firstOrCreate(
            ['session_id' => $sessionId],
            ['shoes_member_id' => Auth::guard('shoes')->id()]
        );
        }

        public function index()
        {
        $cart = $this->getOrCreateCart();
        $cart->load('items.product');

        return view('cart.index', compact('cart'));
        }

        public function add(Request $request)
        {
        // Check if user is logged in
        if (!Auth::guard('shoes')->check()) {
            return redirect()->route('shoes.login')
                ->with('error', 'Please login to add items to your cart');
        }
        
        $product = Product::findOrFail($request->product_id);

        // Check if product is out of stock
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Sorry, this product is out of stock.');
        }

        // Validate stock
        if ($product->stock < $request->quantity) {
            // Adjust quantity to available stock
            $request->merge(['quantity' => $product->stock]);
            
            // Prepare notification message
            session()->flash('info', "Only {$product->stock} items of \"{$product->name}\" are available. Quantity has been adjusted.");
        }

        // Check if product has sizes and colors and validate accordingly
        $rules = [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ];

        // Only require size if the product has sizes
        if (is_array($product->sizes) && count($product->sizes) > 0) {
            $rules['size'] = 'required|string';
        }

        // Only require color if the product has colors
        if (is_array($product->colors) && count($product->colors) > 0) {
            $rules['color'] = 'required|string';
        }

        $request->validate($rules);

        $cart = $this->getOrCreateCart();

        // Check if the item already exists in the cart with the same options
        $existingItem = $cart->items()
            ->where('product_id', $request->product_id)
            ->where('size', $request->size)
            ->where('color', $request->color)
            ->first();

        if ($existingItem) {
            // If item exists, update quantity
            $newQuantity = $existingItem->quantity + $request->quantity;
            
            // Check if new quantity exceeds stock
            if ($newQuantity > $product->stock) {
                $newQuantity = $product->stock;
                session()->flash('info', "Stock for \"{$product->name}\" is limited. Quantity has been adjusted to {$product->stock}.");
            }
            
            $existingItem->update(['quantity' => $newQuantity]);
            
            return redirect()->route('cart.index')->with('success', 'Product quantity updated in cart');
        } else {
            // Create new cart item
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'size' => $request->size,
                'color' => $request->color,
            ]);

            return redirect()->route('cart.index')->with('success', 'Product added to cart successfully');
        }
        }

        public function update(Request $request, CartItem $cartItem)
        {
        $product = $cartItem->product;
        
        // Check if product is out of stock
        if ($product->stock <= 0) {
            return redirect()->route('cart.index')->with('error', "Sorry, \"{$product->name}\" is now out of stock.");
        }
        
        // Automatically adjust quantity if it exceeds stock
        if ($request->quantity > $product->stock) {
            // Set quantity to match available stock
            $request->merge(['quantity' => $product->stock]);
            
            // Set flash message to notify user
            session()->flash('info', "Quantity for \"{$product->name}\" has been adjusted to {$product->stock} due to limited stock.");
        }

        $request->validate([
            'quantity' => [
                'required', 
                'integer', 
                'min:1', 
                "max:{$product->stock}"
            ],
        ], [
            'quantity.max' => "Stock for {$product->name} is only {$product->stock} remaining."
        ]);

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully');
        }

        public function remove(CartItem $cartItem)
        {
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
        }

        public function clear()
        {
        $cart = $this->getOrCreateCart();
        $cart->items()->delete();

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully');
    }
}