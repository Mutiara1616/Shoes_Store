@extends('layouts.app')

@section('title', $category->name . ' Collection - STEP UP')

@section('content')
<div class="bg-white pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center border-b border-gray-200 pb-6 mb-8">
            <h1 class="text-3xl font-bold">{{ $category->name }} Collection</h1>
            <div class="flex items-center">
                <form action="{{ url()->current() }}" method="GET" class="flex">
                    <input type="text" name="search" placeholder="Search {{ $category->name }}'s shoes..." 
                           class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ request('search') }}">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <select name="sort" id="sort" class="ml-4 px-4 py-2 border border-gray-300 rounded-md focus:outline-none"
                        onchange="window.location.href='{{ url()->current() }}?sort='+this.value+'{{ request('brand') ? '&brand='.request('brand') : '' }}{{ request('search') ? '&search='.request('search') : '' }}'">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Sidebar Filters -->
            <div class="md:col-span-1">
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-medium mb-4">Categories</h3>
                    <ul class="space-y-2">
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('category.' . $cat->slug) }}" 
                               class="{{ $category->slug == $cat->slug ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-blue-600' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    <h3 class="text-lg font-medium mt-8 mb-4">Brands</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ url()->current() }}{{ request('sort') ? '?sort='.request('sort') : '' }}" 
                               class="{{ !request('brand') ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-blue-600' }}">
                                All Brands
                            </a>
                        </li>
                        @foreach($brands as $brand)
                        <li>
                            <a href="{{ url()->current() }}?{{ request('sort') ? 'sort='.request('sort').'&' : '' }}brand={{ $brand->slug }}" 
                               class="{{ request('brand') == $brand->slug ? 'text-blue-600 font-medium' : 'text-gray-600 hover:text-blue-600' }}">
                                {{ $brand->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="md:col-span-3">
                @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                    <div class="bg-white rounded-xl overflow-hidden shadow-md transition-transform duration-300 hover:-translate-y-2">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <div class="relative h-64">
                                @php
                                    $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
                                    $image = !empty($images) && is_array($images) ? $images[0] : 'https://via.placeholder.com/300';
                                    
                                    if(is_string($image) && !filter_var($image, FILTER_VALIDATE_URL) && !str_starts_with($image, 'http')) {
                                        $image = asset('storage/' . $image);
                                    }
                                @endphp
                                <img src="{{ $image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @if($product->sale_price && $product->sale_price < $product->price)
                                <div class="absolute top-0 left-0 bg-red-500 text-white text-xs font-bold px-2 py-1 m-2 rounded">
                                    SALE
                                </div>
                                @endif
                                <div class="absolute top-0 right-0 m-2">
                                    <button class="bg-white rounded-full p-2 shadow-md text-gray-400 hover:text-red-500">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </a>
                        <div class="p-4">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm text-gray-500">{{ $product->category_name }}</span>
                                <span class="text-sm text-gray-500">{{ $product->brand_name }}</span>
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
                                <button class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors duration-300">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->appends(request()->query())->links() }}
                </div>
                @else
                <div class="text-center py-12 bg-gray-50 rounded-lg">
                    <i class="fas fa-search text-gray-400 text-5xl mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-600 mb-2">No products found</h3>
                    <p class="text-gray-500">We currently don't have any products in this category. Check back soon!</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection