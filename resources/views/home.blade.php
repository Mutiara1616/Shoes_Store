<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'STEP UP - Premium Footwear')

@section('styles')
<style>
    /* Modern Hero Section */
    .hero-section {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1552346154-21d32810aba3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80');
       background-size: cover;
       background-position: center;
       height: 85vh;
       position: relative;
   }
   
   .hero-overlay {
       position: absolute;
       bottom: 0;
       left: 0;
       right: 0;
       padding: 3rem;
       background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
   }
   
   /* Animated elements */
   .fade-in-up {
       animation: fadeInUp 1s ease both;
   }
   
   .fade-in-up-delay-1 {
       animation: fadeInUp 1s ease 0.3s both;
   }
   
   .fade-in-up-delay-2 {
       animation: fadeInUp 1s ease 0.6s both;
   }
   
   @keyframes fadeInUp {
       from {
           opacity: 0;
           transform: translateY(20px);
       }
       to {
           opacity: 1;
           transform: translateY(0);
       }
   }
   
   /* Smooth hover effects */
   .category-card {
       transition: all 0.5s ease;
       overflow: hidden;
   }
   
   .category-card:hover .category-image {
       transform: scale(1.1);
   }
   
   .category-image {
       transition: transform 0.7s ease;
   }
   
   /* Product card improvements */
   .product-card {
       transition: transform 0.3s ease, box-shadow 0.3s ease;
   }
   
   .product-card:hover {
       transform: translateY(-10px);
       box-shadow: 0 15px 30px rgba(0,0,0,0.1);
   }
   
   /* Rounded elements */
   .btn-rounded {
       border-radius: 30px;
       padding: 0.75rem 2rem;
       transition: all 0.3s ease;
   }
   
   .btn-rounded:hover {
       transform: translateY(-2px);
       box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
   }
   
   /* Newsletter section */
   .newsletter-section {
       background: linear-gradient(45deg, #2563eb, #3b82f6);
   }
   
   /* Custom scrollbar for the whole page */
   ::-webkit-scrollbar {
       width: 8px;
   }
   
   ::-webkit-scrollbar-track {
       background: #f1f1f1;
   }
   
   ::-webkit-scrollbar-thumb {
       background: #3b82f6;
       border-radius: 4px;
   }
   
   ::-webkit-scrollbar-thumb:hover {
       background: #2563eb;
   }
</style>
@endsection

@section('content')
<!-- Hero Section (Enhanced) -->
<section class="hero-section flex items-center justify-center">
   <div class="container mx-auto px-4">
       <div class="max-w-3xl mx-auto text-center">
           <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 fade-in-up">Step Into Style</h1>
           <p class="text-xl md:text-2xl text-white mb-10 fade-in-up-delay-1">Discover premium footwear for every occasion</p>
           <a href="{{ route('category.men') }}" class="inline-block bg-white text-blue-700 px-8 py-4 rounded-full font-medium hover:bg-gray-100 transition-all duration-300 btn-rounded fade-in-up-delay-2">
               Explore Collection
           </a>
       </div>
   </div>
   <div class="hero-overlay">
       <div class="container mx-auto px-4">
           <div class="flex flex-wrap justify-center items-center gap-6">
               <div class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm px-6 py-3 rounded-full flex items-center">
                   <i class="fas fa-shipping-fast mr-3 text-white"></i>
                   <span class="text-white font-medium">Free Shipping Worldwide</span>
               </div>
               <div class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm px-6 py-3 rounded-full flex items-center">
                   <i class="fas fa-undo-alt mr-3 text-white"></i>
                   <span class="text-white font-medium">30-Day Returns</span>
               </div>
               <div class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm px-6 py-3 rounded-full flex items-center">
                   <i class="fas fa-shield-alt mr-3 text-white"></i>
                   <span class="text-white font-medium">Authentic Products</span>
               </div>
           </div>
       </div>
   </div>
</section>

<!-- Featured Categories (Enhanced) -->
<section class="py-24 bg-white">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       <div class="text-center mb-16">
           <h2 class="text-3xl md:text-4xl font-bold mb-4">Featured Categories</h2>
           <p class="text-gray-600 max-w-2xl mx-auto">Explore our curated collection of premium footwear designed for style, comfort, and durability</p>
       </div>
       
       <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
           <div class="category-card rounded-2xl overflow-hidden shadow-lg relative h-96 group">
               <div class="absolute inset-0 bg-gradient-to-t from-black opacity-70 z-10"></div>
               <div class="category-image w-full h-full">
                   <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
                       alt="Men's shoes" class="w-full h-full object-cover">
               </div>
               <div class="absolute bottom-0 left-0 p-8 z-20">
                   <h3 class="text-2xl font-bold text-white mb-3">Men's Collection</h3>
                   <p class="text-gray-200 mb-5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Stylish and comfortable footwear for every occasion</p>
                   <a href="{{ route('category.men') }}" class="inline-flex items-center bg-white text-blue-700 px-5 py-3 rounded-full font-medium hover:bg-blue-700 hover:text-white transition-colors duration-300">
                       Shop Now
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                           <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                       </svg>
                   </a>
               </div>
           </div>
           
           <div class="category-card rounded-2xl overflow-hidden shadow-lg relative h-96 group">
               <div class="absolute inset-0 bg-gradient-to-t from-black opacity-70 z-10"></div>
               <div class="category-image w-full h-full">
                   <img src="https://images.unsplash.com/photo-1554062614-6da4fa67725a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1287&q=80" 
                       alt="Women's shoes" class="w-full h-full object-cover">
               </div>
               <div class="absolute bottom-0 left-0 p-8 z-20">
                   <h3 class="text-2xl font-bold text-white mb-3">Women's Collection</h3>
                   <p class="text-gray-200 mb-5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Elegant designs that combine fashion with function</p>
                   <a href="{{ route('category.women') }}" class="inline-flex items-center bg-white text-blue-700 px-5 py-3 rounded-full font-medium hover:bg-blue-700 hover:text-white transition-colors duration-300">
                       Shop Now
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                           <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                       </svg>
                   </a>
               </div>
           </div>
           
           <div class="category-card rounded-2xl overflow-hidden shadow-lg relative h-96 group">
               <div class="absolute inset-0 bg-gradient-to-t from-black opacity-70 z-10"></div>
               <div class="category-image w-full h-full">
                   <img src="https://images.unsplash.com/photo-1596522354195-e84ae3c98731?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1025&q=80" 
                       alt="Kids' shoes" class="w-full h-full object-cover">
               </div>
               <div class="absolute bottom-0 left-0 p-8 z-20">
                   <h3 class="text-2xl font-bold text-white mb-3">Kids Collection</h3>
                   <p class="text-gray-200 mb-5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Durable and comfortable shoes for active kids</p>
                   <a href="{{ route('category.kids') }}" class="inline-flex items-center bg-white text-blue-700 px-5 py-3 rounded-full font-medium hover:bg-blue-700 hover:text-white transition-colors duration-300">
                       Shop Now
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                           <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                       </svg>
                   </a>
               </div>
           </div>
       </div>
   </div>
</section>

<!-- Featured Products (Enhanced) -->
<section class="py-24 bg-gray-50">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       <div class="flex flex-col md:flex-row justify-between items-center mb-16">
           <div class="mb-6 md:mb-0">
               <h2 class="text-3xl md:text-4xl font-bold">New Arrivals</h2>
               <p class="text-gray-600 mt-2">Check out our latest additions to the collection</p>
           </div>
           <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-full font-medium hover:bg-blue-700 inline-flex items-center btn-rounded">
               View All
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
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

               <div class="product-card bg-white rounded-2xl overflow-hidden shadow-md relative">
                   <a href="{{ route('products.show', $product->slug) }}">
                       <div class="relative h-64 overflow-hidden">
                           <img src="{{ $image }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500">
                           @if($product->sale_price && $product->sale_price < $product->price)
                               <div class="absolute top-0 left-0 bg-red-500 text-white text-xs font-bold px-3 py-1.5 m-3 rounded-full">
                                   SALE
                               </div>
                           @endif
                           
                           @if($product->is_featured)
                           @endif
                       </div>
                   </a>

                   <!-- Wishlist -->
                   <div class="absolute top-3 right-3 z-10">
                       @auth('shoes')
                           @php
                               $wishlistItem = Auth::guard('shoes')->user()->wishlistItems()->where('product_id', $product->id)->first();
                               $inWishlist = !is_null($wishlistItem);
                           @endphp
                           
                           @if($inWishlist)
                               <form action="{{ route('wishlist.remove', $wishlistItem->id) }}" method="POST" class="inline">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" class="bg-white rounded-full p-3 shadow-md text-red-500 hover:text-red-700 transition-colors duration-200 hover:shadow-lg">
                                       <i class="fas fa-heart"></i>
                                   </button>
                               </form>
                           @else
                               <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="inline">
                                   @csrf
                                   <button type="submit" class="bg-white rounded-full p-3 shadow-md text-gray-400 hover:text-red-500 transition-colors duration-200 hover:shadow-lg">
                                       <i class="far fa-heart"></i>
                                   </button>
                               </form>
                           @endif
                       @else
                           <a href="{{ route('shoes.login') }}" class="bg-white rounded-full p-3 shadow-md text-gray-400 hover:text-red-500 inline-block hover:shadow-lg"
                              onclick="event.preventDefault(); showLoginNotification();">
                               <i class="far fa-heart"></i>
                           </a>
                       @endauth
                   </div>

                   <div class="p-5">
                       <div class="flex justify-between items-center mb-2">
                           <span class="text-sm text-blue-600 font-medium px-3 py-1 bg-blue-50 rounded-full">{{ $product->category->name ?? 'Uncategorized' }}</span>
                           <span class="text-sm text-gray-500">{{ $product->brand->name ?? '' }}</span>
                       </div>
                       <h3 class="text-xl font-medium text-gray-900 mb-2">
                           <a href="{{ route('products.show', $product->slug) }}" class="hover:text-blue-600 transition-colors">
                               {{ $product->name }}
                           </a>
                       </h3>
                       <div class="flex justify-between items-center">
                           <div>
                               @if($product->sale_price && $product->sale_price < $product->price)
                                   <span class="text-xl font-bold text-red-600">Rp{{ number_format($product->sale_price, 0, ',', '.') }}</span>
                                   <span class="text-sm text-gray-400 line-through ml-1">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                               @else
                                   <span class="text-xl font-bold text-gray-900">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                               @endif
                           </div>

                           @if(Auth::guard('shoes')->check())
                               @if(empty($product->sizes) && empty($product->colors))
                                   <form action="{{ route('cart.add') }}" method="POST">
                                       @csrf
                                       <input type="hidden" name="product_id" value="{{ $product->id }}">
                                       <input type="hidden" name="quantity" value="1">
                                       <button type="submit" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition-colors duration-300 shadow-md hover:shadow-lg">
                                           <i class="fas fa-shopping-cart"></i>
                                       </button>
                                   </form>
                               @else
                                   <a href="{{ route('products.show', $product->slug) }}" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition-colors duration-300 inline-flex items-center justify-center shadow-md hover:shadow-lg">
                                       <i class="fas fa-shopping-cart"></i>
                                   </a>
                               @endif
                           @else
                               <a href="{{ route('shoes.login') }}" 
                                  onclick="event.preventDefault(); showLoginCartNotification();" 
                                  class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition-colors duration-300 inline-flex items-center justify-center shadow-md hover:shadow-lg">
                                   <i class="fas fa-shopping-cart"></i>
                               </a>
                           @endif
                       </div>
                   </div>
               </div>
           @empty
               <div class="col-span-4 text-center py-16 bg-white rounded-2xl shadow-sm">
                   <div class="text-blue-600 mb-4">
                       <i class="fas fa-box-open text-5xl"></i>
                   </div>
                   <h3 class="text-xl font-medium text-gray-900 mb-2">No featured products available yet</h3>
                   <p class="text-gray-600 mb-6">Check back soon for our latest releases</p>
                   <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-full font-medium hover:bg-blue-700 inline-block btn-rounded">
                       Browse All Products
                   </a>
               </div>
           @endforelse
       </div>
   </div>
</section>

<!-- New Promotion Banner -->
<section class="py-16 bg-gradient-to-r from-blue-900 to-blue-700 relative overflow-hidden">
   <div class="absolute inset-0 overflow-hidden">
       <svg class="absolute left-0 top-0 h-full opacity-10" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
           <circle cx="500" cy="500" r="400" fill="white" />
           <circle cx="500" cy="500" r="300" fill="none" stroke="white" stroke-width="20" />
           <circle cx="500" cy="500" r="200" fill="white" />
       </svg>
   </div>
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
       <div class="md:flex items-center justify-between">
           <div class="md:w-1/2 mb-10 md:mb-0">
               <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Summer Collection 2025</h2>
               <p class="text-blue-100 text-lg mb-8 max-w-md">Discover our new summer styles with up to 40% off. Limited time offer for premium comfort and style.</p>
               <a href="{{ route('products.sale') }}" class="inline-block bg-white text-blue-700 px-8 py-4 rounded-full font-medium hover:bg-gray-100 transition-all duration-300 btn-rounded">
                   Shop the Sale
               </a>
           </div>
           <div class="md:w-1/2 flex justify-center">
               <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1287&q=80" 
                    alt="Summer collection" class="max-h-80 rounded-2xl shadow-2xl transform rotate-2 hover:rotate-0 transition-transform duration-500">
           </div>
       </div>
   </div>
</section>

<!-- Features Grid -->
<section class="py-16 bg-white">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       <div class="text-center mb-16">
           <h2 class="text-3xl md:text-4xl font-bold mb-4">Why Choose STEP UP</h2>
           <p class="text-gray-600 max-w-2xl mx-auto">We're dedicated to providing the best experience for our customers</p>
       </div>
       
       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
           <div class="bg-gray-50 p-6 rounded-2xl text-center hover:shadow-lg transition-shadow duration-300">
               <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                   <i class="fas fa-shipping-fast text-blue-600 text-xl"></i>
               </div>
               <h3 class="text-xl font-medium text-gray-900 mb-2">Fast Delivery</h3>
               <p class="text-gray-600">Free shipping worldwide with quick delivery to your doorstep</p>
           </div>
           
           <div class="bg-gray-50 p-6 rounded-2xl text-center hover:shadow-lg transition-shadow duration-300">
               <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                   <i class="fas fa-shield-alt text-blue-600 text-xl"></i>
               </div>
               <h3 class="text-xl font-medium text-gray-900 mb-2">Quality Guarantee</h3>
               <p class="text-gray-600">All our products are authentic and made with premium materials</p>
           </div>
           
           <div class="bg-gray-50 p-6 rounded-2xl text-center hover:shadow-lg transition-shadow duration-300">
               <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                   <i class="fas fa-undo-alt text-blue-600 text-xl"></i>
               </div>
               <h3 class="text-xl font-medium text-gray-900 mb-2">Easy Returns</h3>
               <p class="text-gray-600">30-day hassle-free return policy for your peace of mind</p>
           </div>
           
           <div class="bg-gray-50 p-6 rounded-2xl text-center hover:shadow-lg transition-shadow duration-300">
               <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                   <i class="fas fa-headset text-blue-600 text-xl"></i>
               </div>
               <h3 class="text-xl font-medium text-gray-900 mb-2">24/7 Support</h3>
               <p class="text-gray-600">Our friendly customer service team is always ready to help you</p>
           </div>
       </div>
   </div>
</section>

<!-- Newsletter Section (Enhanced) -->
<section class="py-16 newsletter-section">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
       <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-sm rounded-2xl p-12 max-w-3xl mx-auto">
           <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Join Our Newsletter</h2>
           <p class="text-blue-100 mb-8 max-w-2xl mx-auto">Stay updated with the latest styles, releases, and exclusive offers.</p>
           
           <form class="max-w-md mx-auto flex">
               <input type="email" placeholder="Your email address" class="flex-grow px-6 py-4 rounded-l-full focus:outline-none focus:ring-2 focus:ring-blue-500">
               <button type="submit" class="bg-blue-800 text-white px-8 py-4 rounded-r-full font-medium hover:bg-blue-900 transition-colors duration-300">
                   Subscribe
               </button>
           </form>
           
           <div class="mt-8 flex justify-center gap-6">
               <a href="#" class="text-white hover:text-blue-200 transition-colors">
                   <i class="fab fa-facebook-f text-xl"></i>
               </a>
               <a href="#" class="text-white hover:text-blue-200 transition-colors">
                   <i class="fab fa-instagram text-xl"></i>
               </a>
               <a href="#" class="text-white hover:text-blue-200 transition-colors">
                   <i class="fab fa-twitter text-xl"></i>
               </a>
               <a href="#" class="text-white hover:text-blue-200 transition-colors">
                   <i class="fab fa-pinterest-p text-xl"></i>
               </a>
           </div>
       </div>
   </div>
</section>
@endsection

<!-- AI Assistant Chat Widget (Like Screenshot) -->
<div id="chat-widget" class="fixed bottom-5 right-5 z-50">
   <!-- Chat button -->
   <button id="chat-button" class="bg-blue-600 hover:bg-blue-700 text-white rounded-full w-16 h-16 flex items-center justify-center shadow-lg transition-all duration-300 focus:outline-none">
       <i class="fas fa-comment-alt text-xl"></i>
   </button>
   
   <!-- Chat window -->
   <div id="chat-window" class="hidden bg-white rounded-xl overflow-hidden w-80 sm:w-96 flex flex-col shadow-2xl">
       <!-- Chat header -->
       <div class="bg-white text-gray-800 px-4 py-3 flex justify-between items-center border-b">
           <div class="flex items-center">
               <h3 class="font-medium text-lg">STEP UP</h3>
           </div>
           <div class="flex items-center space-x-3">
               <button class="text-gray-400 hover:text-gray-600 focus:outline-none">
                   <i class="fas fa-redo-alt"></i>
               </button>
               <button class="text-gray-400 hover:text-gray-600 focus:outline-none">
                   <i class="fas fa-trash-alt"></i>
               </button>
               <button id="close-chat" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                   <i class="fas fa-times"></i>
               </button>
           </div>
       </div>
       
       <!-- Chat messages container with fixed height -->
       <div id="chat-messages" class="flex-1 overflow-y-auto bg-white"></div>
       
       <!-- Chat input -->
       <div class="border-t border-gray-200 p-3 bg-white">
        <form id="chat-form" class="flex items-center">
            <input id="chat-input" type="text" placeholder="Tanyakan STEP UP" class="flex-1 px-4 py-2 border border-gray-300 rounded-l focus:outline-none focus:ring-1 focus:ring-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r hover:bg-blue-700 focus:outline-none">
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>
        <div class="text-xs text-gray-500 mt-2 text-center">Informasi dari AI mungkin tidak akurat</div>
    </div>
</div>
</div>

<style>
/* Modern chat widget styling */
#chat-window {
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    max-height: 70vh;
}

#chat-messages {
    overflow-y: auto !important; 
    height: 400px !important;
    display: flex;
    flex-direction: column;
    padding: 0;
    gap: 0;
    scroll-behavior: smooth;
    background-color: #ffffff;
}

#chat-messages::-webkit-scrollbar {
    width: 5px;
}

#chat-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
}

#chat-messages::-webkit-scrollbar-thumb {
    background-color: #d1d5db;
    border-radius: 10px;
}

/* User message bubble */
.user-message-wrapper {
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    width: 100%;
    padding: 12px 16px;
}

.user-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background-color: #e5e7eb;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 12px;
    flex-shrink: 0;
}

.user-avatar i {
    color: #6b7280;
    font-size: 12px;
}

.user-message {
    font-size: 14px;
    color: #111827;
    max-width: calc(100% - 40px);
    word-wrap: break-word;
    word-break: break-word;
    overflow-wrap: break-word;
}

/* Assistant message bubble */
.assistant-message-wrapper {
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    width: 100%;
    padding: 12px 16px;
    background-color: #f9f9f9;
}

.assistant-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background-color: #6366f1;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 12px;
    flex-shrink: 0;
}

.assistant-avatar i {
    color: white;
    font-size: 12px;
}

.assistant-message {
    font-size: 14px;
    color: #111827;
    max-width: calc(100% - 40px);
    word-wrap: break-word;
    word-break: break-word;
    overflow-wrap: break-word;
}

.assistant-message ol {
    list-style-type: decimal;
    padding-left: 24px;
    margin: 12px 0;
}

.assistant-message ol li {
    margin-bottom: 12px;
    line-height: 1.5;
    padding-left: 4px;
}

.assistant-message .list-item-title {
    font-weight: 600;
}

.assistant-message p {
    margin-bottom: 8px;
    line-height: 1.5;
}

/* Emoji styling */
.emoji {
    display: inline;
    font-size: 16px;
    vertical-align: middle;
}

/* Typing indicator */
.typing-indicator {
    display: inline-flex;
    align-items: center;
}

.typing-indicator span {
    height: 8px;
    width: 8px;
    margin: 0 1px;
    background-color: #9CA3AF;
    border-radius: 50%;
    display: inline-block;
    animation: typing 1.4s infinite ease-in-out both;
}

.typing-indicator span:nth-child(1) {
    animation-delay: 0s;
}

.typing-indicator span:nth-child(2) {
    animation-delay: 0.2s;
}

.typing-indicator span:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes typing {
    0% { transform: scale(0.6); opacity: 0.4; }
    50% { transform: scale(1); opacity: 1; }
    100% { transform: scale(0.6); opacity: 0.4; }
}

/* Animation effects */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.fade-in {
    animation: fadeIn 0.3s ease forwards;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatButton = document.getElementById('chat-button');
    const chatWindow = document.getElementById('chat-window');
    const closeChat = document.getElementById('close-chat');
    const chatMessages = document.getElementById('chat-messages');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    
    // Welcome message with greeting first
    const welcomeMessage = {
        text: "Halo! Selamat datang di Step UP, asisten virtual untuk kebutuhan sepatu Anda. 👋 Saya siap membantu menemukan sepatu yang tepat sesuai kebutuhan Anda. Ada yang bisa saya bantu hari ini?",
        sender: 'assistant'
    };

    // Toggle chat window
    chatButton.addEventListener('click', function() {
        chatWindow.classList.toggle('hidden');
        if (!chatWindow.classList.contains('hidden')) {
            chatButton.style.display = 'none';
        } else {
            chatButton.style.display = 'flex';
        }
        
        // Show welcome message if it's the first time opening
        if (chatMessages.children.length === 0) {
            displayMessage(welcomeMessage);
        }
    });
    
    // Close chat window
    closeChat.addEventListener('click', function() {
        chatWindow.classList.add('hidden');
        chatButton.style.display = 'flex';
    });
    
    // Handle form submission
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = chatInput.value.trim();
        if (message) {
            // Display user message
            displayMessage({
                text: message,
                sender: 'user'
            });
            
            // Clear input
            chatInput.value = '';
            
            // Show typing indicator
            showTypingIndicator();
            
            // Send message to backend or use test responses
            sendMessageToAI(message);
        }
    });
    
    function showTypingIndicator() {
        const typingWrapper = document.createElement('div');
        typingWrapper.className = 'assistant-message-wrapper fade-in';
        typingWrapper.id = 'typing-indicator-wrapper';
        
        const avatarDiv = document.createElement('div');
        avatarDiv.className = 'assistant-avatar';
        avatarDiv.innerHTML = '<i class="fas fa-shoe-prints"></i>';
        
        const typingIndicator = document.createElement('div');
        typingIndicator.className = 'assistant-message typing-indicator';
        typingIndicator.innerHTML = '<span></span><span></span><span></span>';
        typingIndicator.id = 'typing-indicator';
        
        typingWrapper.appendChild(avatarDiv);
        typingWrapper.appendChild(typingIndicator);
        chatMessages.appendChild(typingWrapper);
        
        // Scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    function removeTypingIndicator() {
        const typingWrapper = document.getElementById('typing-indicator-wrapper');
        if (typingWrapper) {
            typingWrapper.remove();
        }
    }
    
    // Advanced formatting function to handle special cases like in screenshot
    function formatMessage(text) {
        // Escape HTML to prevent XSS
        text = text.replace(/</g, '&lt;').replace(/>/g, '&gt;');
        
        // Handle numbered lists with titles
        if (/\d+\.\s.+/.test(text)) {
            // Process numbered lists with titles (e.g., "1. **Title:** Content")
            text = text.replace(/(\d+)\.\s+\*\*([^:*]+):\*\*\s*(.+?)(?=\n\n\d+\.|\n\n|$)/gs, function(match, number, title, content) {
                return `<ol start="${number}" style="counter-reset: item ${number-1};"><li><span class="list-item-title">${title}:</span> ${content}</li></ol>`;
            });
            
            // If we still have numbered items that weren't caught
            text = text.replace(/(\d+)\.\s+(.+?)(?=\n\n\d+\.|\n\n|$)/gs, function(match, number, content) {
                return `<ol start="${number}" style="counter-reset: item ${number-1};"><li>${content}</li></ol>`;
            });
        }
        
        // Handle bold formatting without showing ** (complete removal)
        text = text.replace(/\*\*([^*]+)\*\*/g, '<strong>$1</strong>');
        
        // Make emojis slightly larger and properly spaced
        text = text.replace(/([\uD800-\uDBFF][\uDC00-\uDFFF])/g, '<span class="emoji">$1</span>');
        
        // Convert paragraph breaks
        const paragraphs = text.split(/\n\n+/);
        if (paragraphs.length > 1) {
            text = paragraphs.map(p => p.trim() ? `<p>${p.replace(/\n/g, '<br>')}</p>` : '').join('');
        } else {
            text = `<p>${text.replace(/\n/g, '<br>')}</p>`;
        }
        
        return text;
    }
    
    function displayMessage(message) {
        const messageWrapper = document.createElement('div');
        messageWrapper.className = message.sender === 'user' ? 'user-message-wrapper fade-in' : 'assistant-message-wrapper fade-in';
        
        const avatarDiv = document.createElement('div');
        
        if (message.sender === 'user') {
            avatarDiv.className = 'user-avatar';
            avatarDiv.innerHTML = '<i class="fas fa-user"></i>';
        } else {
            avatarDiv.className = 'assistant-avatar';
            avatarDiv.innerHTML = '<i class="fas fa-shoe-prints"></i>';
        }
        
        const messageDiv = document.createElement('div');
        messageDiv.className = message.sender === 'user' ? 'user-message' : 'assistant-message';
        messageDiv.innerHTML = formatMessage(message.text);
        
        messageWrapper.appendChild(avatarDiv);
        messageWrapper.appendChild(messageDiv);
        chatMessages.appendChild(messageWrapper);
        
        setTimeout(() => {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 100);
    }
    
    async function sendMessageToAI(message) {
        try {
            setTimeout(() => {
                removeTypingIndicator();
                
                displayMessage({
                    text: getTestResponse(message),
                    sender: 'assistant'
                });
            }, 1500);
            
            const response = await fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message })
            });
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            const data = await response.json();
            
            removeTypingIndicator();
            
            displayMessage({
                text: data.response,
                sender: 'assistant'
            });

        } catch (error) {
            console.error('Error:', error);
            
            removeTypingIndicator();
            
            displayMessage({
                text: "Maaf, saya sedang mengalami masalah koneksi. Silakan coba lagi nanti.",
                sender: 'assistant'
            });
        }
    }
});
</script>