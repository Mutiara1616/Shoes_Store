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
                
                <div class="border-t border-b border-gray-200 py-4">
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-900 mb-2">Size</h3>
                        <div class="grid grid-cols-4 gap-2">
                            @if(is_array($product->sizes) || is_object($product->sizes))
                                @foreach($product->sizes as $size)
                                <button class="border border-gray-300 rounded-md py-2 px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    {{ $size }}
                                </button>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-900 mb-2">Color</h3>
                        <div class="flex space-x-3">
                            @if(is_array($product->colors) || is_object($product->colors))
                                @foreach($product->colors as $color)
                                <button class="border-2 border-gray-300 rounded-full w-8 h-8 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                                        style="background-color: {{ $color }};">
                                </button>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="flex border border-gray-300 rounded-md">
                        <button class="px-3 py-2 text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="text" value="1" class="w-12 text-center border-l border-r border-gray-300 py-2 focus:outline-none">
                        <button class="px-3 py-2 text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    
                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-md font-medium flex items-center justify-center">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Add to Cart
                    </button>
                    
                    <button class="p-3 border border-gray-300 rounded-md hover:bg-gray-50">
                        <i class="far fa-heart text-gray-600"></i>
                    </button>
                </div>
                
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
@endsection