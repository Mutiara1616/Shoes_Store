<!-- resources/views/checkout/success.blade.php -->
@extends('layouts.app')

@section('title', 'Order Confirmed - STEP UP')

@section('content')
<div class="bg-white pt-24 pb-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-4">
                <i class="fas fa-check text-green-600 text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Order Confirmed!</h1>
            <p class="text-gray-600">Thank you for your purchase. Your order has been received.</p>
        </div>
        
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden mb-8">
            <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">Order #{{ $order->order_number }}</h2>
                        <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('F d, Y') }}</p>
                    </div>
                    <div class="mt-2 md:mt-0">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="px-6 py-4">
                <h3 class="text-base font-medium text-gray-900 mb-3">Items in your order</h3>
                
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                    <div class="flex items-start border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                        <div class="h-16 w-16 flex-shrink-0">
                            @php
                                $images = is_array($item->product->images) ? $item->product->images : json_decode($item->product->images, true);
                                $image = !empty($images) && is_array($images) ? $images[0] : 'https://via.placeholder.com/300';
                                
                                // If it's a storage path, use asset helper
                                if(is_string($image) && !filter_var($image, FILTER_VALIDATE_URL) && !str_starts_with($image, 'http')) {
                                    $image = asset('storage/' . $image);
                                }
                            @endphp
                            <img src="{{ $image }}" alt="{{ $item->product->name }}" class="h-16 w-16 object-cover rounded">
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex justify-between">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        @if($item->size)
                                            Size: {{ $item->size }} &middot;
                                        @endif
                                        @if($item->color)
                                            Color: {{ $item->color }} &middot;
                                        @endif
                                        Qty: {{ $item->quantity }}
                                    </p>
                                </div>
                                <p class="text-sm font-medium text-gray-900">
                                    Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="border-t border-gray-200 px-6 py-4">
                <div class="flex justify-between text-sm mb-2">
                    <p class="text-gray-600">Subtotal</p>
                    <p class="font-medium">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                </div>
                <div class="flex justify-between text-sm mb-2">
                    <p class="text-gray-600">Shipping</p>
                    <p class="font-medium">Free</p>
                </div>
                <div class="flex justify-between text-sm mb-4">
                    <p class="text-gray-600">Tax</p>
                    <p class="font-medium">Included</p>
                </div>
                <div class="flex justify-between text-base font-medium border-t border-gray-200 pt-4">
                    <p>Total</p>
                    <p>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                <h3 class="text-base font-medium text-gray-900 mb-3">Shipping Information</h3>
                <address class="not-italic text-sm text-gray-600">
                    <p>{{ Auth::guard('shoes')->user()->name }}</p>
                    <p>{{ $order->shipping_address }}</p>
                    <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zipcode }}</p>
                    <p>Phone: {{ $order->shipping_phone }}</p>
                </address>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                <h3 class="text-base font-medium text-gray-900 mb-3">Payment Information</h3>
                <div class="text-sm text-gray-600">
                    <p class="flex items-center">
                        <i class="far fa-credit-card mr-2 text-blue-500"></i>
                        Paid using Credit Card
                    </p>
                    <p class="mt-1">Amount: Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        
        <div class="text-center">
            <p class="text-gray-600 mb-4">An email confirmation has been sent to your registered email address.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                    <i class="fas fa-user-circle mr-2"></i>
                    Go to Dashboard
                </a>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</div>
@endsection