<!-- resources/views/mens-shoes.blade.php -->
@extends('layouts.app')

@section('title', 'STEP UP - Men\'s Footwear Collection')

@section('styles')
<style>
    .hero-section {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1491553895911-0055eca6402d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80');
        background-size: cover;
        background-position: center;
        height: 60vh;
    }
    
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .filter-option:hover {
        background-color: #f3f4f6;
    }
    
    .filter-option.active {
        background-color: #e5e7eb;
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-5xl font-bold text-white mb-4">Men's Collection</h1>
        <p class="text-xl text-white mb-8">Premium footwear designed for the modern man</p>
    </div>
</section>

<!-- Breadcrumb -->
<nav class="bg-gray-100 py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <ol class="flex items-center space-x-2 text-sm">
            <li>
                <a href="/" class="text-blue-600 hover:text-blue-800">Home</a>
            </li>
            <li class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="ml-2 font-medium">Men's Collection</span>
            </li>
        </ol>
    </div>
</nav>

<!-- Filter and Products -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-4 lg:gap-8">
            <!-- Filters Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Filters</h3>
                    
                    <!-- Categories -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Categories</h4>
                        <div class="space-y-2">
                            <div class="filter-option cursor-pointer p-2 rounded active">
                                <span>All Men's Shoes</span>
                            </div>
                            <div class="filter-option cursor-pointer p-2 rounded">
                                <span>Running</span>
                            </div>
                            <div class="filter-option cursor-pointer p-2 rounded">
                                <span>Basketball</span>
                            </div>
                            <div class="filter-option cursor-pointer p-2 rounded">
                                <span>Casual</span>
                            </div>
                            <div class="filter-option cursor-pointer p-2 rounded">
                                <span>Hiking</span>
                            </div>
                            <div class="filter-option cursor-pointer p-2 rounded">
                                <span>Formal</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Price Range -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Price Range</h4>
                        <div class="space-y-2">
                            <div class="filter-option cursor-pointer p-2 rounded">
                                <span>Under $50</span>
                            </div>
                            <div class="filter-option cursor-pointer p-2 rounded active">
                                <span>$50 - $100</span>
                            </div>
                            <div class="filter-option cursor-pointer p-2 rounded">
                                <span>$100 - $150</span>
                            </div>
                            <div class="filter-option cursor-pointer p-2 rounded">
                                <span>$150 - $200</span>
                            </div>
                            <div class="filter-option cursor-pointer p-2 rounded">
                                <span>$200+</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Size -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Size</h4>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach([7, 7.5, 8, 8.5, 9, 9.5, 10, 10.5, 11, 11.5, 12, 13] as $size)
                            <div class="filter-option cursor-pointer p-2 rounded text-center border">
                                <span>{{ $size }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Color -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Color</h4>
                        <div class="flex flex-wrap gap-3">
                            <div class="h-8 w-8 rounded-full bg-black cursor-pointer border-2 border-transparent hover:border-gray-300"></div>
                            <div class="h-8 w-8 rounded-full bg-white cursor-pointer border-2 border-gray-300 hover:border-gray-400"></div>
                            <div class="h-8 w-8 rounded-full bg-blue-600 cursor-pointer border-2 border-transparent hover:border-gray-300"></div>
                            <div class="h-8 w-8 rounded-full bg-red-600 cursor-pointer border-2 border-transparent hover:border-gray-300"></div>
                            <div class="h-8 w-8 rounded-full bg-gray-600 cursor-pointer border-2 border-transparent hover:border-gray-300"></div>
                            <div class="h-8 w-8 rounded-full bg-green-600 cursor-pointer border-2 border-transparent hover:border-gray-300"></div>
                        </div>
                    </div>
                    
                    <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-300">Apply Filters</button>
                </div>
            </div>
            
            <!-- Products Grid -->
            <div class="mt-6 lg:mt-0 lg:col-span-3">
                <!-- Sort and View Options -->
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-500"><span class="font-medium text-gray-900">24</span> products</p>
                    
                    <div class="flex items-center space-x-4">
                        <label for="sort" class="text-sm text-gray-700">Sort by:</label>
                        <select id="sort" class="border border-gray-300 rounded p-2 text-sm">
                            <option>Featured</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest</option>
                            <option>Best Selling</option>
                        </select>
                    </div>
                </div>
                
                <!-- Products -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <!-- Product 1 - Performance Runner -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow border border-gray-100">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1025&q=80" 
                                 alt="Performance Runner" class="w-full h-64 object-cover">
                            <div class="absolute top-0 right-0 m-4 bg-white rounded-full p-2 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-red-500 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="absolute top-0 left-0 m-4 bg-blue-600 text-white text-xs px-2 py-1 rounded">New</div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Performance Runner</h3>
                            <p class="text-sm text-gray-500 mb-2">Men's Running Shoes</p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">$129.99</span>
                                <button class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 2 - Air Zoom High -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow border border-gray-100">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1287&q=80" 
                                 alt="Air Zoom High" class="w-full h-64 object-cover">
                            <div class="absolute top-0 right-0 m-4 bg-white rounded-full p-2 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-red-500 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Air Zoom High</h3>
                            <p class="text-sm text-gray-500 mb-2">Basketball Shoes</p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">$149.99</span>
                                <button class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 3 - Classic Canvas -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow border border-gray-100">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1112&q=80" 
                                 alt="Classic Canvas" class="w-full h-64 object-cover">
                            <div class="absolute top-0 right-0 m-4 bg-white rounded-full p-2 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-red-500 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="absolute top-0 left-0 m-4 bg-green-600 text-white text-xs px-2 py-1 rounded">Sale</div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Classic Canvas</h3>
                            <p class="text-sm text-gray-500 mb-2">Casual Sneakers</p>
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-lg font-bold text-gray-900">$59.99</span>
                                    <span class="text-sm text-gray-500 line-through ml-2">$79.99</span>
                                </div>
                                <button class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 4 - Trail Explorer -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow border border-gray-100">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1608666634759-4376010f863d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
                                 alt="Trail Explorer" class="w-full h-64 object-cover">
                            <div class="absolute top-0 right-0 m-4 bg-white rounded-full p-2 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-red-500 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Trail Explorer</h3>
                            <p class="text-sm text-gray-500 mb-2">Hiking Boots</p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">$159.99</span>
                                <button class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 5 - Urban Loafer -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow border border-gray-100">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1614253429340-98120bd6d753?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
                                 alt="Urban Loafer" class="w-full h-64 object-cover">
                            <div class="absolute top-0 right-0 m-4 bg-white rounded-full p-2 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-red-500 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Urban Loafer</h3>
                            <p class="text-sm text-gray-500 mb-2">Casual Formal Shoes</p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">$89.99</span>
                                <button class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product 6 - Street Skater -->
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow border border-gray-100">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=998&q=80" 
                                 alt="Street Skater" class="w-full h-64 object-cover">
                            <div class="absolute top-0 right-0 m-4 bg-white rounded-full p-2 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-red-500 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="absolute top-0 left-0 m-4 bg-red-600 text-white text-xs px-2 py-1 rounded">Best Seller</div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Street Skater</h3>
                            <p class="text-sm text-gray-500 mb-2">Skateboarding Shoes</p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">$74.99</span>
                                <button class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- More products... -->
                </div>
                
                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <a href="#" class="px-3 py-2 rounded border border-gray-300 text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="px-4 py-2 rounded border border-blue-500 bg-blue-500 text-white font-medium">1</a>
                        <a href="#" class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-50">2</a>
                        <a href="#" class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-50">3</a>
                        <span class="px-3 py-2 text-gray-500">...</span>
                        <a href="#" class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-50">8</a>
                        <a href="#" class="px-3 py-2 rounded border border-gray-300 text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="bg-blue-600 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Join Our Newsletter</h2>
            <p class="text-blue-100 mb-6 max-w-2xl mx-auto">Stay updated with the latest releases, exclusive offers, and style tips delivered straight to your inbox.</p>
            <form class="max-w-md mx-auto flex">
                <input type="email" placeholder="Your email address" class="flex-1 px-4 py-3 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-400">
                <button type="submit" class="bg-blue-800 hover:bg-blue-900 text-white px-6 py-3 rounded-r font-medium transition duration-300">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Free Shipping -->
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 text-blue-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Free Shipping</h3>
                <p class="text-gray-500">Free standard shipping on all orders over $100</p>
            </div>
            
            <!-- Easy Returns -->
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 text-blue-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Easy Returns</h3>
                <p class="text-gray-500">30-day return policy with no questions asked</p>
            </div>
            
            <!-- Secure Payment -->
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 text-blue-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Secure Payment</h3>
                <p class="text-gray-500">All transactions are secure and encrypted</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-white">
    <!-- Main Footer -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Brand Info -->
            <div>
                <h2 class="text-xl font-bold mb-4">STEP UP</h2>
                <p class="text-gray-400 mb-6">Premium footwear for every occasion. Quality, comfort, and style for the modern man.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-medium mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Home</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Shop</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                </ul>
            </div>
            
            <!-- Collections -->
            <div>
                <h3 class="text-lg font-medium mb-4">Collections</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Men's Collection</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Women's Collection</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Kids Collection</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">New Arrivals</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Sale</a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div>
                <h3 class="text-lg font-medium mb-4">Contact Us</h3>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>123 Fashion Street, New York, NY 10001</span>
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>+1 (555) 123-4567</span>
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>info@stepup.com</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Copyright -->
    <div class="border-t border-gray-800 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:justify-between items-center">
            <p class="text-gray-400">© 2025 STEP UP. All rights reserved.</p>
            <div class="mt-4 md:mt-0">
                <ul class="flex space-x-6">
                    <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Terms of Service</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Cookie Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
@endsection