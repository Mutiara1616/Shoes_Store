<div class="bg-white rounded-xl overflow-hidden shadow-md transition-transform duration-300 hover:-translate-y-2 relative">
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
            
            @if($product->stock <= 0)
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <span class="bg-red-500 text-white px-4 py-2 rounded-full font-bold">SOLD OUT</span>
                </div>
            @endif
            
            @if($product->sale_price && $product->sale_price < $product->price && $product->stock > 0)
                <div class="absolute top-0 left-0 bg-red-500 text-white text-xs font-bold px-2 py-1 m-2 rounded">
                    SALE
                </div>
            @endif
        </div>
    </a>
    
    <!-- Wishlist icon -->
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
            <a href="{{ route('shoes.login') }}" class="bg-white rounded-full p-2 shadow-md text-gray-400 hover:text-red-500 inline-block"
               onclick="event.preventDefault(); showLoginNotification();">
                <i class="far fa-heart"></i>
            </a>
        @endauth
    </div>
    
    <div class="p-4">
        <div class="flex justify-between items-center mb-1">
            <span class="text-sm text-gray-500">{{ $product->category->name ?? $product->category_name ?? 'Uncategorized' }}</span>
            <span class="text-sm text-gray-500">{{ $product->brand->name ?? $product->brand_name ?? '' }}</span>
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
            
            @if($product->stock > 0)
                @if(Auth::guard('shoes')->check())
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
                @else
                    <a href="{{ route('shoes.login') }}" 
                       onclick="event.preventDefault(); showLoginCartNotification();" 
                       class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors duration-300 inline-flex items-center justify-center">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                @endif
            @else
                <button class="bg-gray-300 text-white p-2 rounded-full cursor-not-allowed" disabled>
                    <i class="fas fa-shopping-cart"></i>
                </button>
            @endif
        </div>
    </div>
</div>