<?php
// app/Http/Controllers/CheckoutController.php

namespace App\Http\Controllers;
use App\Models\Product; // Pastikan ini ada di bagian atas file
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
        // 1. Validasi Alamat Pengiriman
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:100',
            'shipping_state' => 'required|string|max:100',
            'shipping_zipcode' => 'required|string|max:20',
            'shipping_phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500',
        ]);

        // 2. Validasi Keranjang dan User
        $cart = app(CartController::class)->getOrCreateCart();
        if ($cart->items->isEmpty()) {
            return redirect()->route('products.index')
                ->with('error', 'Keranjang Anda kosong.');
        }

        if (!Auth::guard('shoes')->check()) {
            return redirect()->route('shoes.login')
                ->with('error', 'Silakan login untuk melanjutkan checkout.');
        }

        // 3. Pre-Check Stok (Sebelum Transaksi)
        foreach ($cart->items as $item) {
            $product = Product::find($item->product_id);

            if (!$product || $product->stock < $item->quantity) {
                return redirect()->route('cart.index')
                    ->with('error', "Stok {$product->name} tidak mencukupi.");
            }
        }

        DB::beginTransaction();

        try {
            // 4. Validasi Akhir + Locking (Dalam Transaksi)
            $order = Order::create([/* data order... */]);

            foreach ($cart->items as $item) {
                $product = Product::lockForUpdate()->find($item->product_id);

                // Double-check stok dengan locking
                if ($product->stock < $item->quantity) {
                    throw new \Exception("Stok {$product->name} habis saat proses checkout.");
                }

                // Kurangi stok dengan atomic decrement
                $product->decrement('stock', $item->quantity);

                $order->orderItems()->create([/* data item... */]);
            }

            $cart->items()->delete();
            DB::commit();

            return redirect()->route('checkout.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Error: ' . $e->getMessage());
            return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
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
