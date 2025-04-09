<!-- resources/views/products/show.blade.php -->
@extends('layouts.app')

@section('title', $product->name . ' - STEP UP')

@section('content')
<div class="bg-white pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex py-4 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-blue-600">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="mx-2 text-gray-400">/</span>
                        <a href="{{ route('category.' . $product->category->slug) }}" class="text-gray-500 hover:text-blue-600">{{ $product->category->name }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <span class="mx-2 text-gray-400">/</span>
                        <span class="text-gray-700">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Product Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Product Images -->
            <div class="space-y-4">
                @php
                    $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
                    $mainImage = !empty($images) ? $images[0] : 'https://via.placeholder.com/600';
                @endphp
                
                <!-- Main Image -->
                <div class="aspect-w-3 aspect-h-2 rounded-lg overflow-hidden bg-gray-100">
                    <img src="{{ asset('storage/' . $mainImage) }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                </div>
                
                <!-- Thumbnail Images -->
                @if(count($images) > 1)
                <div class="grid grid-cols-4 gap-2">
                    @foreach($images as $image)
                    <div class="aspect-w-1 aspect-h-1 rounded-md overflow-hidden cursor-pointer">
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            
            <!-- Product Info -->
            <div class="space-y-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                    <div class="flex items-center mt-2">
                        <p class="text-gray-500">{{ $product->brand->name }}</p>
                        <span class="mx-2 text-gray-300">|</span>
                        <div class="flex items-center">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <p class="ml-2 text-sm text-gray-500">(4.0) · 24 reviews</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    @if($product->sale_price && $product->sale_price < $product->price)
                    <p class="text-3xl font-bold text-red-600">Rp{{ number_format($product->sale_price, 0, ',', '.') }}</p>
                    <p class="text-lg text-gray-400 line-through">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    @else
                    <p class="text-3xl font-bold text-gray-900">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    @endif
                </div>
                
                <!-- Add to Cart Form -->
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @if(Auth::guard('shoes')->check())
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="border-t border-b border-gray-200 py-4">
                            <div class="mb-4">
                                <h3 class="text-sm font-medium text-gray-900 mb-2">
                                    Size
                                    @if(is_array($product->sizes) && count($product->sizes) > 0)
                                        <span class="text-red-500">*</span>
                                    @endif
                                </h3>
                                <div class="grid grid-cols-4 gap-2">
                                    @if(is_array($product->sizes) || is_object($product->sizes))
                                        @foreach($product->sizes as $size)
                                        <button type="button" 
                                                class="size-button border border-gray-300 rounded-md py-2 px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" 
                                                data-size="{{ $size }}">
                                            {{ $size }}
                                        </button>
                                        @endforeach
                                    @endif
                                </div>
                                @error('size')
                                    <p class="mt-1 text-sm text-red-600">{{ $errors->first('size') }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <h3 class="text-sm font-medium text-gray-900 mb-2">
                                    Color
                                    @if(is_array($product->colors) && count($product->colors) > 0)
                                        <span class="text-red-500">*</span>
                                    @endif
                                </h3>
                                <div class="flex space-x-3">
                                    @if(is_array($product->colors) || is_object($product->colors))
                                        @foreach($product->colors as $color)
                                        <button type="button" 
                                                class="color-button border-2 border-gray-300 rounded-full w-8 h-8 focus:outline-none" 
                                                style="background-color: {{ $color }};"
                                                data-color="{{ $color }}">
                                        </button>
                                        @endforeach
                                    @endif
                                </div>
                                @error('color')
                                    <p class="mt-1 text-sm text-red-600">{{ $errors->first('color') }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4 mt-6">
                            <div class="flex border border-gray-300 rounded-md">
                                <button type="button" class="px-3 py-2 text-gray-600 hover:bg-gray-100 quantity-decrease">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" value="1" min="1" 
                                    class="w-12 text-center border-l border-r border-gray-300 py-2 focus:outline-none quantity-input">
                                <button type="button" class="px-3 py-2 text-gray-600 hover:bg-gray-100 quantity-increase">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            
                            <input type="hidden" name="size" id="selected_size">
                            <input type="hidden" name="color" id="selected_color">
                            
                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-md font-medium flex items-center justify-center">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Add to Cart
                            </button>
                        </div>
                    </form>
                @else
                    <div class="border-t border-b border-gray-200 py-4">
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-900 mb-2">
                                Size
                                @if(is_array($product->sizes) && count($product->sizes) > 0)
                                    <span class="text-red-500">*</span>
                                @endif
                            </h3>
                            <div class="grid grid-cols-4 gap-2">
                                @if(is_array($product->sizes) || is_object($product->sizes))
                                    @foreach($product->sizes as $size)
                                    <button type="button" 
                                            class="size-button border border-gray-300 rounded-md py-2 px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                        {{ $size }}
                                    </button>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-900 mb-2">
                                Color
                                @if(is_array($product->colors) && count($product->colors) > 0)
                                    <span class="text-red-500">*</span>
                                @endif
                            </h3>
                            <div class="flex space-x-3">
                                @if(is_array($product->colors) || is_object($product->colors))
                                    @foreach($product->colors as $color)
                                    <button type="button" 
                                            class="color-button border-2 border-gray-300 rounded-full w-8 h-8 focus:outline-none" 
                                            style="background-color: {{ $color }};">
                                    </button>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4 mt-6">
                        <div class="flex border border-gray-300 rounded-md">
                            <button type="button" class="px-3 py-2 text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" value="1" min="1" 
                                class="w-12 text-center border-l border-r border-gray-300 py-2 focus:outline-none">
                            <button type="button" class="px-3 py-2 text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        
                        <a href="{{ route('shoes.login') }}" 
                           onclick="event.preventDefault(); showLoginCartNotification();" 
                           class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-md font-medium flex items-center justify-center">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Add to Cart
                        </a>
                    </div>
                @endif
                
                <!-- Wishlist button - Separate from the cart form -->
                @auth('shoes')
                    <form action="{{ route('wishlist.add', $product) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="flex items-center text-gray-600 hover:text-red-600">
                            @if(Auth::guard('shoes')->user()->wishlistItems()->where('product_id', $product->id)->exists())
                                <i class="fas fa-heart text-red-600 mr-2"></i>
                                <span>Added to Wishlist</span>
                            @else
                                <i class="far fa-heart mr-2"></i>
                                <span>Add to Wishlist</span>
                            @endif
                        </button>
                    </form>
                @else
                    <a href="{{ route('shoes.login') }}" class="mt-4 flex items-center text-gray-600 hover:text-gray-800"
                       onclick="event.preventDefault(); showLoginNotification();">
                        <i class="far fa-heart mr-2"></i>
                        <span>Add to Wishlist</span>
                    </a>
                @endauth
                
                <div class="pt-4">
                    <p class="text-green-600 flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>In stock - ready to ship</span>
                    </p>
                    
                    <div class="mt-2 flex space-x-6 text-sm text-gray-500">
                        <div class="flex items-center">
                            <i class="fas fa-shipping-fast mr-2"></i>
                            <span>Free shipping</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-sync-alt mr-2"></i>
                            <span>30 day returns</span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                    <div class="prose prose-blue">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-6">You May Also Like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <div class="bg-white rounded-xl overflow-hidden shadow-md transition-transform duration-300 hover:-translate-y-2">
                    <a href="{{ route('products.show', $related->slug) }}">
                        <div class="relative h-64">
                            @php
                                $relatedImages = is_array($related->images) ? $related->images : json_decode($related->images, true);
                                $relatedImage = !empty($relatedImages) ? $relatedImages[0] : 'https://via.placeholder.com/300';
                            @endphp
                            <img src="{{ asset('storage/' . $relatedImage) }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                        </div>
                    </a>
                    <div class="p-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            <a href="{{ route('products.show', $related->slug) }}" class="hover:text-blue-600">
                                {{ $related->name }}
                            </a>
                        </h3>
                        <div class="flex justify-between items-center mt-2">
                            <div>
                                @if($related->sale_price && $related->sale_price < $related->price)
                                <span class="text-lg font-bold text-red-600">Rp{{ number_format($related->sale_price, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-400 line-through ml-1">Rp{{ number_format($related->price, 0, ',', '.') }}</span>
                                @else
                                <span class="text-lg font-bold text-gray-900">Rp{{ number_format($related->price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Size selection
        const sizeButtons = document.querySelectorAll('.size-button');
        sizeButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all size buttons
                sizeButtons.forEach(btn => {
                    btn.classList.remove('ring-2', 'ring-blue-500');
                    btn.classList.add('hover:bg-gray-50');
                });
                
                // Add active class to clicked button
                this.classList.add('ring-2', 'ring-blue-500');
                this.classList.remove('hover:bg-gray-50');
                
                // Update hidden input
                document.getElementById('selected_size').value = this.getAttribute('data-size');
            });
        });
        
        // Color selection
        const colorButtons = document.querySelectorAll('.color-button');
        colorButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all color buttons
                colorButtons.forEach(btn => {
                    btn.classList.remove('ring-2', 'ring-offset-2', 'ring-blue-500');
                });
                
                // Add active class to clicked button
                this.classList.add('ring-2', 'ring-offset-2', 'ring-blue-500');
                
                // Update hidden input
                document.getElementById('selected_color').value = this.getAttribute('data-color');
            });
        });
        
        // Quantity buttons
        const decreaseButton = document.querySelector('.quantity-decrease');
        const increaseButton = document.querySelector('.quantity-increase');
        const quantityInput = document.querySelector('.quantity-input');
        
        decreaseButton.addEventListener('click', function() {
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });
        
        increaseButton.addEventListener('click', function() {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });
    });
</script>
@endsection