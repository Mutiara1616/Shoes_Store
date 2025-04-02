<?php
// app/Http/Controllers/CheckoutController.php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        // Redirect if cart is empty
        $cart = app(CartController::class)->getOrCreateCart();
        if ($cart->items->isEmpty()) {
            return redirect()->route('products.index')
                ->with('error', 'Your cart is empty');
        }
        
        // If user is not logged in, redirect to login
        if (!Auth::guard('shoes')->check()) {
            return redirect()->route('shoes.login')
                ->with('error', 'Please login to proceed with checkout');
        }
        
        $cart->load('items.product');
        
        return view('checkout.index', compact('cart'));
    }
    
    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_state' => 'required|string',
            'shipping_zipcode' => 'required|string',
            'shipping_phone' => 'required|string',
            'notes' => 'nullable|string',
        ]);
        
        // Get cart
        $cart = app(CartController::class)->getOrCreateCart();
        if ($cart->items->isEmpty()) {
            return redirect()->route('products.index')
                ->with('error', 'Your cart is empty');
        }
        
        // If user is not logged in, redirect to login
        if (!Auth::guard('shoes')->check()) {
            return redirect()->route('shoes.login')
                ->with('error', 'Please login to proceed with checkout');
        }
        
        DB::beginTransaction();
        
        try {
            // Create order
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'shoes_member_id' => Auth::guard('shoes')->id(),
                'status' => 'pending',
                'total_amount' => $cart->total,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_state' => $request->shipping_state,
                'shipping_zipcode' => $request->shipping_zipcode,
                'shipping_phone' => $request->shipping_phone,
                'notes' => $request->notes,
            ]);
            
            // Create order items
            foreach ($cart->items as $item) {
                $order->orderItems()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->sale_price ?? $item->product->price,
                    'size' => $item->size,
                    'color' => $item->color,
                ]);
                
                // Update product stock
                $product = $item->product;
                $product->stock -= $item->quantity;
                $product->save();
            }
            
            // Clear cart
            $cart->items()->delete();
            
            DB::commit();
            
            return redirect()->route('checkout.success', ['order' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }
    
    public function success(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->shoes_member_id !== Auth::guard('shoes')->id()) {
            abort(403);
        }
        
        $order->load('orderItems.product');
        
        return view('checkout.success', compact('order'));
    }
}