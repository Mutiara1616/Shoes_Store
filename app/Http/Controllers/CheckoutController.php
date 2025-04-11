<?php
// app/Http/Controllers/CheckoutController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        // Pre-Check Stok (Before Transaction)
        $cart = app(CartController::class)->getOrCreateCart();
        $outOfStockItems = [];

        foreach ($cart->items as $item) {
            $product = Product::find($item->product_id);

            if (!$product || $product->stock < $item->quantity) {
                $outOfStockItems[] = [
                    'name' => $product->name,
                    'available_stock' => $product->stock
                ];
            }
        }

        // If any products are out of stock
        if (!empty($outOfStockItems)) {
            $errorMessage = "Stok produk tidak mencukupi:\n";
            foreach ($outOfStockItems as $item) {
                $errorMessage .= "- {$item['name']} (Stok tersedia: {$item['available_stock']})\n";
            }
            
            return redirect()->route('cart.index')->with('error', $errorMessage);
        }

        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:100',
            'shipping_state' => 'required|string|max:100',
            'shipping_zipcode' => 'required|string|max:20',
            'shipping_phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500',
        ]);

        // Make sure cart is not empty
        if ($cart->items->isEmpty()) {
            return redirect()->route('products.index')
                ->with('error', 'Your cart is empty.');
        }

        // Make sure user is logged in
        if (!Auth::guard('shoes')->check()) {
            return redirect()->route('shoes.login')
                ->with('error', 'Please login to continue checkout.');
        }

        DB::beginTransaction();

        try {
            // Create the order with complete data
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'shoes_member_id' => Auth::guard('shoes')->id(),
                'status' => 'pending',
                'total_amount' => $cart->total,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_state' => $request->shipping_state,
                'shipping_zipcode' => $request->shipping_zipcode,
                'shipping_phone' => $request->shipping_phone,
                'notes' => $request->notes
            ]);

            // Process each item in the cart
            foreach ($cart->items as $item) {
                // Lock the product row to prevent race conditions
                $product = Product::lockForUpdate()->find($item->product_id);

                // Double-check stock availability
                if ($product->stock < $item->quantity) {
                    throw new \Exception("Stock for {$product->name} is insufficient during checkout.");
                }

                // Decrease product stock
                $product->decrement('stock', $item->quantity);

                // Calculate the price (use sale_price if available)
                $price = $product->sale_price && $product->sale_price < $product->price 
                    ? $product->sale_price 
                    : $product->price;

                // Create order item
                $order->orderItems()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $price,
                    'size' => $item->size,
                    'color' => $item->color
                ]);
            }

            // Clear the cart after successful order creation
            $cart->items()->delete();
            
            DB::commit();

            return redirect()->route('checkout.success', $order);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Error: ' . $e->getMessage());
            return back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        // Security check: Make sure the order belongs to the logged-in user
        if ($order->shoes_member_id !== Auth::guard('shoes')->id()) {
            abort(403, 'Unauthorized access to order');
        }

        // Load the order with all its items and product details
        $order->load('orderItems.product');

        return view('checkout.success', compact('order'));
    }
}