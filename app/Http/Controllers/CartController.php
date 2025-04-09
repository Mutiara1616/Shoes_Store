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
        $sessionId = session()->get('cart_session_id');

        if (!$sessionId) {
            $sessionId = Str::uuid();
            session()->put('cart_session_id', $sessionId);
        }

        $cart = Cart::firstOrCreate(
            ['session_id' => $sessionId],
            ['shoes_member_id' => Auth::guard('shoes')->id()]
        );

        // If user is logged in but cart doesn't have shoes_member_id
        if (Auth::guard('shoes')->check() && !$cart->shoes_member_id) {
            $cart->update(['shoes_member_id' => Auth::guard('shoes')->id()]);
        }

        return $cart;
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

        // Check if product already exists in cart with same size and color
        $cartItem = $cart->items()
            ->where('product_id', $request->product_id)
            ->where('size', $request->size)
            ->where('color', $request->color)
            ->first();

        if ($cartItem) {
            // Update quantity if item exists
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity
            ]);
        } else {
            // Create new cart item
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'size' => $request->size,
                'color' => $request->color,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $product = $cartItem->product;

        $request->validate([
            'quantity' => 'required|integer|min:1|max:'.$product->stock,
        ]);

        // Validasi stok tambahan
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok produk tidak mencukupi');
        }

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