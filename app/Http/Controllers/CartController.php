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
        // Periksa apakah user sudah login
        if (!Auth::guard('shoes')->check()) {
            return redirect()->route('shoes.login')
                ->with('error', 'Please login to add items to your cart');
        }
        
        $product = Product::findOrFail($request->product_id);

        // Validasi stok
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok produk tidak mencukupi');
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

        // Debug lines
        \Log::info('Adding to cart', [
            'cart_id' => $cart->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);

        $cartItem = $cart->items()->create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'size' => $request->size,
            'color' => $request->color,
        ]);

        // Debug line
        \Log::info('Cart item created', [
            'cart_item_id' => $cartItem->id,
            'cart_id' => $cartItem->cart_id
        ]);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $product = $cartItem->product;

        $request->validate([
            'quantity' => [
                'required', 
                'integer', 
                'min:1', 
                "max:{$product->stock}"
            ],
        ], [
            'quantity.max' => "Stok produk {$product->name} hanya tersisa {$product->stock}."
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