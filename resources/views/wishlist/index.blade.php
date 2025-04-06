@extends('layouts.app')

@section('title', 'My Wishlist - STEP UP')

@section('content')
<div class="bg-white pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">My Wishlist</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        @if(session('info'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-6 relative" role="alert">
                <span class="block sm:inline">{{ session('info') }}</span>
            </div>
        @endif
        
        @if($wishlistItems->isEmpty())
            <div class="bg-gray-50 rounded-lg p-8 text-center">
                <i class="far fa-heart text-gray-400 text-5xl mb-4"></i>
                <h2 class="text-2xl font-medium text-gray-600 mb-2">Your wishlist is empty</h2>
                <p class="text-gray-500 mb-6">Save items you love to your wishlist and review them anytime.</p>
                <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md font-medium hover:bg-blue-700 transition-colors">
                    Browse Products
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($wishlistItems as $item)
                <div class="bg-white rounded-xl overflow-hidden shadow-md transition-transform duration-300 hover:-translate-y-2 relative">
                    <a href="{{ route('products.show', $item->product->slug) }}">
                        <div class="h-64">
                            @php
                                $images = is_array($item->product->images) ? $item->product->images : json_decode($item->product->images, true);
                                $image = !empty($images) && is_array($images) ? $images[0] : 'https://via.placeholder.com/300';
                                
                                if(is_string($image) && !filter_var($image, FILTER_VALIDATE_URL) && !str_starts_with($image, 'http')) {
                                    $image = asset('storage/' . $image);
                                }
                            @endphp
                            <img src="{{ $image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                        </div>
                    </a>
                    
                    <!-- Remove from wishlist button -->
                    <div class="absolute top-0 right-0 m-2">
                        <form action="{{ route('wishlist.remove', $item) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-white rounded-full p-2 shadow-md text-red-500 hover:text-red-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                    
                    <div class="p-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            <a href="{{ route('products.show', $item->product->slug) }}" class="hover:text-blue-600">
                                {{ $item->product->name }}
                            </a>
                        </h3>
                        <div class="flex justify-between items-center mt-2">
                            <div>
                                @if($item->product->sale_price && $item->product->sale_price < $item->product->price)
                                <span class="text-lg font-bold text-red-600">Rp{{ number_format($item->product->sale_price, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-400 line-through ml-1">Rp{{ number_format($item->product->price, 0, ',', '.') }}</span>
                                @else
                                <span class="text-lg font-bold text-gray-900">Rp{{ number_format($item->product->price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            
                            @php
                                $requiresOptions = (is_array($item->product->sizes) && count($item->product->sizes) > 0) || 
                                                 (is_array($item->product->colors) && count($item->product->colors) > 0);
                            @endphp
                            
                            @if($requiresOptions)
                                <!-- Product requires options - redirect to product page -->
                                <a href="{{ route('products.show', $item->product->slug) }}" class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors duration-300 inline-block">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                            @else
                                <!-- Product doesn't require options - move directly to cart -->
                                <form action="{{ route('wishlist.moveToCart', $item) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors duration-300">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection