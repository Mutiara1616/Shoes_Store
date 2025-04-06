<!-- resources/views/checkout/index.blade.php -->
@extends('layouts.app')

@section('title', 'Checkout - STEP UP')

@section('content')
<div class="bg-white pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">Checkout</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Order Summary -->
            <div class="md:col-span-1 order-2 md:order-1">
                <div class="bg-gray-50 rounded-lg p-6 shadow-sm sticky top-28">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>
                    
                    <div class="space-y-3 mb-4">
                        @foreach($cart->items as $item)
                        <div class="flex items-start border-b border-gray-200 pb-3">
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
                            <div class="ml-3 flex-1">
                                <div class="flex justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $item->product->name }}</p>
                                        <p class="text-xs text-gray-500">
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
                                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between text-sm mb-2">
                            <p class="text-gray-600">Subtotal</p>
                            <p class="font-medium">Rp{{ number_format($cart->total, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-between text-sm mb-2">
                            <p class="text-gray-600">Shipping</p>
                            <p class="font-medium">Free</p>
                        </div>
                        <div class="flex justify-between text-sm mb-4">
                            <p class="text-gray-600">Tax</p>
                            <p class="font-medium">Included</p>
                        </div>
                        <div class="flex justify-between text-base font-medium">
                            <p>Total</p>
                            <p>Rp{{ number_format($cart->total, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 text-center text-sm text-gray-500">
                        <p class="mb-2">We accept the following payment methods</p>
                        <div class="flex justify-center space-x-2">
                            <i class="fab fa-cc-visa text-gray-400 text-2xl"></i>
                            <i class="fab fa-cc-mastercard text-gray-400 text-2xl"></i>
                            <i class="fab fa-cc-amex text-gray-400 text-2xl"></i>
                            <i class="fab fa-cc-paypal text-gray-400 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Checkout Form -->
            <div class="md:col-span-2 order-1 md:order-2">
                <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Shipping Information</h2>
                    
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        
                        <!-- Customer Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" id="name" value="{{ Auth::guard('shoes')->user()->name }}" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    readonly>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input type="email" id="email" value="{{ Auth::guard('shoes')->user()->email }}" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    readonly>
                            </div>
                        </div>
                        
                        <!-- Shipping Address -->
                        <div class="mb-4">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                            <input type="text" id="shipping_address" name="shipping_address" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                required>
                            @error('shipping_address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                <input type="text" id="shipping_city" name="shipping_city" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    required>
                                @error('shipping_city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="shipping_state" class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                                <input type="text" id="shipping_state" name="shipping_state" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    required>
                                @error('shipping_state')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="shipping_zipcode" class="block text-sm font-medium text-gray-700 mb-1">ZIP/Postal Code</label>
                                <input type="text" id="shipping_zipcode" name="shipping_zipcode" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    required>
                                @error('shipping_zipcode')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <label for="shipping_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="text" id="shipping_phone" name="shipping_phone" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                required>
                            @error('shipping_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Order Notes (Optional)</label>
                            <textarea id="notes" name="notes" rows="3" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Payment Details -->
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Payment Details</h2>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div class="border border-gray-300 rounded-md p-4 cursor-pointer bg-blue-50 border-blue-500">
                                    <input type="radio" id="credit_card" name="payment_method" value="credit_card" checked class="hidden">
                                    <label for="credit_card" class="flex items-center cursor-pointer">
                                        <div class="bg-white rounded-full h-5 w-5 border border-blue-500 flex items-center justify-center mr-2">
                                            <div class="bg-blue-500 rounded-full h-3 w-3"></div>
                                        </div>
                                        <span class="flex items-center">
                                            <i class="far fa-credit-card mr-2 text-blue-500"></i>
                                            Credit Card
                                        </span>
                                    </label>
                                </div>
                                <div class="border border-gray-300 rounded-md p-4 cursor-pointer opacity-50">
                                    <input type="radio" id="paypal" name="payment_method" value="paypal" disabled class="hidden">
                                    <label for="paypal" class="flex items-center cursor-not-allowed">
                                        <div class="bg-white rounded-full h-5 w-5 border border-gray-300 flex items-center justify-center mr-2"></div>
                                        <span class="flex items-center">
                                            <i class="fab fa-paypal mr-2"></i>
                                            PayPal
                                        </span>
                                    </label>
                                </div>
                                <div class="border border-gray-300 rounded-md p-4 cursor-pointer opacity-50">
                                    <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer" disabled class="hidden">
                                    <label for="bank_transfer" class="flex items-center cursor-not-allowed">
                                        <div class="bg-white rounded-full h-5 w-5 border border-gray-300 flex items-center justify-center mr-2"></div>
                                        <span class="flex items-center">
                                            <i class="fas fa-university mr-2"></i>
                                            Bank Transfer
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="card_name" class="block text-sm font-medium text-gray-700 mb-1">Name on Card</label>
                                <input type="text" id="card_name" name="card_name" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                                <input type="text" id="card_number" name="card_number" placeholder="**** **** **** ****"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div>
                                <label for="expiry_month" class="block text-sm font-medium text-gray-700 mb-1">Expiry Month</label>
                                <select id="expiry_month" name="expiry_month" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label for="expiry_year" class="block text-sm font-medium text-gray-700 mb-1">Expiry Year</label>
                                <select id="expiry_year" name="expiry_year" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label for="cvv" class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                <input type="text" id="cvv" name="cvv" placeholder="***"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        
                        <div class="mt-8 flex justify-between">
                            <a href="{{ route('cart.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Back to Cart
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                                Complete Order
                                <i class="fas fa-check-circle ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection