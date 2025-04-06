@extends('layouts.app')

@section('title', 'Your Shopping Cart - STEP UP')

@section('content')
<div class="bg-white pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">Your Shopping Cart</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        @if($cart->items->isEmpty())
            <div class="bg-gray-50 rounded-lg p-8 text-center">
                <i class="fas fa-shopping-cart text-gray-400 text-5xl mb-4"></i>
                <h2 class="text-2xl font-medium text-gray-600 mb-2">Your cart is empty</h2>
                <p class="text-gray-500 mb-6">Looks like you haven't added any items to your cart yet.</p>
                <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md font-medium hover:bg-blue-700 transition-colors">
                    Browse Products
                </a>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($cart->items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
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
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="{{ route('products.show', $item->product->slug) }}" class="hover:text-blue-600">
                                                    {{ $item->product->name }}
                                                </a>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                @if($item->size)
                                                    <span class="mr-2">Size: {{ $item->size }}</span>
                                                @endif
                                                @if($item->color)
                                                    <span>Color: {{ $item->color }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if($item->product->sale_price && $item->product->sale_price < $item->product->price)
                                            <span class="font-bold text-red-600">Rp{{ number_format($item->product->sale_price, 0, ',', '.') }}</span>
                                            <span class="text-xs text-gray-400 line-through ml-1">Rp{{ number_format($item->product->price, 0, ',', '.') }}</span>
                                        @else
                                            <span>Rp{{ number_format($item->product->price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center" id="update-form-{{ $item->id }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="flex border border-gray-300 rounded-md">
                                            <button type="button" class="px-3 py-1 text-gray-600 hover:bg-gray-100 quantity-decrease" data-item-id="{{ $item->id }}">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" 
                                                class="w-12 text-center border-x border-gray-300 py-1 focus:outline-none quantity-input no-spinners" 
                                                data-item-id="{{ $item->id }}">
                                            <button type="button" class="px-3 py-1 text-gray-600 hover:bg-gray-100 quantity-increase" data-item-id="{{ $item->id }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
                    <div class="flex justify-between items-center">
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 flex items-center">
                                <i class="fas fa-trash mr-1"></i>
                                Clear Cart
                            </button>
                        </form>
                        <div class="text-right">
                            <p class="text-lg text-gray-700">Subtotal: <span class="font-bold">Rp{{ number_format($cart->total, 0, ',', '.') }}</span></p>
                            <p class="text-sm text-gray-500">Taxes and shipping calculated at checkout</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 flex justify-between">
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Continue Shopping
                </a>
                <a href="{{ route('checkout.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                    Proceed to Checkout
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    /* Remove browser default spinners (arrows) from number inputs */
    input.no-spinners::-webkit-outer-spin-button,
    input.no-spinners::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    /* For Firefox */
    input.no-spinners[type=number] {
        -moz-appearance: textfield;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to submit the form
        function updateCart(itemId) {
            document.getElementById('update-form-' + itemId).submit();
        }
        
        // Quantity buttons functionality
        const decreaseButtons = document.querySelectorAll('.quantity-decrease');
        const increaseButtons = document.querySelectorAll('.quantity-increase');
        const quantityInputs = document.querySelectorAll('.quantity-input');
        
        decreaseButtons.forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-item-id');
                const input = document.querySelector('.quantity-input[data-item-id="' + itemId + '"]');
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                    updateCart(itemId);
                }
            });
        });
        
        increaseButtons.forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-item-id');
                const input = document.querySelector('.quantity-input[data-item-id="' + itemId + '"]');
                input.value = parseInt(input.value) + 1;
                updateCart(itemId);
            });
        });
        
        // Update on direct input change as well
        quantityInputs.forEach(input => {
            input.addEventListener('change', function() {
                const itemId = this.getAttribute('data-item-id');
                if (parseInt(this.value) >= 1) {
                    updateCart(itemId);
                }
            });
        });
    });
</script>
@endsection