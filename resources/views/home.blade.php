<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'STEP UP - Premium Footwear')

@section('styles')
<style>
    .hero-section {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1552346154-21d32810aba3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80');
        background-size: cover;
        background-position: center;
        height: 80vh;
    }
    
    .featured-product {
        transition: transform 0.3s ease;
    }
    
    .featured-product:hover {
        transform: translateY(-10px);
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-5xl font-bold text-white mb-4">Step Into Style</h1>
        <p class="text-xl text-white mb-8">Discover premium footwear for every occasion</p>
        <a href="#" class="bg-white text-gray-900 px-8 py-3 rounded-full font-medium hover:bg-gray-100 transition-colors duration-300">Shop Now</a>
    </div>
</section>

<!-- Featured Categories -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Featured Categories</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="relative rounded-lg overflow-hidden h-80 group">
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
                     alt="Men's shoes" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black opacity-70"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h3 class="text-2xl font-bold text-white mb-2">Men's Collection</h3>
                    <a href="#" class="text-white hover:text-blue-200 font-medium flex items-center">
                        Shop Now
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="relative rounded-lg overflow-hidden h-80 group">
                <img src="https://images.unsplash.com/photo-1554062614-6da4fa67725a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1287&q=80" 
                     alt="Women's shoes" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black opacity-70"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h3 class="text-2xl font-bold text-white mb-2">Women's Collection</h3>
                    <a href="#" class="text-white hover:text-blue-200 font-medium flex items-center">
                        Shop Now
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="relative rounded-lg overflow-hidden h-80 group">
                <img src="https://images.unsplash.com/photo-1596522354195-e84ae3c98731?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1025&q=80" 
                     alt="Kids' shoes" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black opacity-70"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h3 class="text-2xl font-bold text-white mb-2">Kids Collection</h3>
                    <a href="#" class="text-white hover:text-blue-200 font-medium flex items-center">
                        Shop Now
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold">New Arrivals</h2>
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                View All
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($featuredProducts as $product)
                @php
                    $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
                    $image = !empty($images) ? $images[0] : 'https://via.placeholder.com/400x300';

                    if (is_string($image) && !filter_var($image, FILTER_VALIDATE_URL) && !str_starts_with($image, 'http')) {
                        $image = asset('storage/' . $image);
                    }
                @endphp

                <div class="bg-white rounded-xl overflow-hidden shadow-md transition-transform duration-300 hover:-translate-y-2 relative">
                    <a href="{{ route('products.show', $product->slug) }}">
                        <div class="relative h-64">
                            <img src="{{ $image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @if($product->sale_price && $product->sale_price < $product->price)
                                <div class="absolute top-0 left-0 bg-red-500 text-white text-xs font-bold px-2 py-1 m-2 rounded">
                                    SALE
                                </div>
                            @endif
                        </div>
                    </a>

                    <!-- Wishlist -->
                    <div class="absolute top-0 right-0 m-2">
                        @auth('shoes')
                            @php
                                $wishlistItem = Auth::guard('shoes')->user()->wishlistItems()->where('product_id', $product->id)->first();
                                $inWishlist = !is_null($wishlistItem);
                            @endphp
                            
                            @if($inWishlist)
                                <form action="{{ route('wishlist.remove', $wishlistItem->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-white rounded-full p-2 shadow-md text-red-500 hover:text-red-700 transition-colors duration-200">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-white rounded-full p-2 shadow-md text-gray-400 hover:text-red-500 transition-colors duration-200">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('shoes.login') }}" class="bg-white rounded-full p-2 shadow-md text-gray-400 hover:text-red-500 inline-block">
                                <i class="far fa-heart"></i>
                            </a>
                        @endauth
                    </div>

                    <div class="p-4">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            <span class="text-sm text-gray-500">{{ $product->brand_name ?? '' }}</span>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">
                            <a href="{{ route('products.show', $product->slug) }}" class="hover:text-blue-600">
                                {{ $product->name }}
                            </a>
                        </h3>
                        <div class="flex justify-between items-center mt-2">
                            <div>
                                @if($product->sale_price && $product->sale_price < $product->price)
                                    <span class="text-lg font-bold text-red-600">Rp{{ number_format($product->sale_price, 0, ',', '.') }}</span>
                                    <span class="text-sm text-gray-400 line-through ml-1">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-lg font-bold text-gray-900">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                @endif
                            </div>

                            @if(empty($product->sizes) && empty($product->colors))
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors duration-300">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('products.show', $product->slug) }}" class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors duration-300 inline-flex items-center justify-center">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-8">
                    <p>No featured products available yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-blue-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-2">Join Our Newsletter</h2>
        <p class="text-blue-100 mb-8 max-w-2xl mx-auto">Stay updated with the latest styles, releases, and exclusive offers.</p>
        
        <form class="max-w-md mx-auto flex">
            <input type="email" placeholder="Your email address" class="flex-grow px-6 py-3 rounded-l-3xl focus:outline-none">
            <button type="submit" class="bg-white text-blue-600 px-6 py-3 rounded-r-3xl font-medium hover:bg-gray-100 transition-colors duration-300">Subscribe</button>
        </form>
    </div>
</section>
@endsection