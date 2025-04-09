<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">STEP UP</a>
                </div>
                <div class="hidden md:ml-10 md:flex md:space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">Home</a>
                    <a href="{{ route('category.men') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('category.men') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">Men</a>
                    <a href="{{ route('category.women') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('category.women') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">Women</a>
                    <a href="{{ route('category.kids') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('category.kids') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">Kids</a>
                    <a href="{{ route('products.sale') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('products.sale') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">Sale</a>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <!-- Wishlist Link -->
                <div class="relative">
                    @if(Auth::guard('shoes')->check())
                        <a href="{{ route('wishlist.index') }}" class="text-gray-700 hover:text-blue-600">
                            <i class="far fa-heart text-xl"></i>
                        </a>
                    @else
                        <a href="{{ route('shoes.login') }}" class="text-gray-700 hover:text-blue-600" 
                           onclick="event.preventDefault(); showLoginNotification();">
                            <i class="far fa-heart text-xl"></i>
                        </a>
                    @endif
                    
                    @php
                        $wishlistCount = Auth::guard('shoes')->check() ? Auth::guard('shoes')->user()->wishlistItems()->count() : 0;
                    @endphp
                    @if($wishlistCount > 0)
                        <div class="absolute -top-1 -right-1">
                            <div class="bg-red-500 text-white text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center">
                                {{ $wishlistCount > 9 ? '9+' : $wishlistCount }}
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Cart Link -->
                <div class="relative">
                    <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-blue-600">
                        <i class="fas fa-shopping-bag text-xl"></i>
                    </a>
                    @php
                        // Perbaikan perhitungan jumlah item cart
                        if(Auth::guard('shoes')->check()) {
                            // Jika user login, ambil dari user ID
                            $cart = App\Models\Cart::where('shoes_member_id', Auth::guard('shoes')->id())->first();
                        } else {
                            // Jika belum login, ambil dari session ID
                            $sessionId = session()->get('cart_session_id');
                            $cart = $sessionId ? App\Models\Cart::where('session_id', $sessionId)->first() : null;
                        }
                        
                        // Hitung jumlah item, bukan jumlah jenis produk
                        $cartCount = $cart ? $cart->items->sum('quantity') : 0;
                    @endphp
                    @if($cartCount > 0)
                        <div class="absolute -top-1 -right-1">
                            <div class="bg-red-500 text-white text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center">
                                {{ $cartCount > 9 ? '9+' : $cartCount }}
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- User Account -->
                <div class="relative">
                    @if(Auth::guard('shoes')->check())
                        <div x-data="{ open: false }">
                            <button @click="open = !open" type="button" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                                <i class="fas fa-user-circle text-xl"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                <form method="POST" action="{{ route('shoes.logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('shoes.login') }}" class="text-gray-700 hover:text-blue-600">
                            <i class="fas fa-user-circle text-xl"></i>
                        </a>
                    @endif
                </div>
                
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-700 hover:text-blue-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="md:hidden bg-white shadow-lg">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">Home</a>
            <a href="{{ route('category.men') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('category.men') ? 'text-blue-600' : '' }}">Men</a>
            <a href="{{ route('category.women') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('category.women') ? 'text-blue-600' : '' }}">Women</a>
            <a href="{{ route('category.kids') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('category.kids') ? 'text-blue-600' : '' }}">Kids</a>
            <a href="{{ route('products.sale') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('products.sale') ? 'text-blue-600' : '' }}">Sale</a>
            <a href="{{ route('wishlist.index') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Wishlist</a>
            <a href="{{ route('cart.index') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Cart</a>
        </div>
    </div>
</nav>
<script>
    function showLoginNotification() {
        // Cek apakah elemen notifikasi sudah ada
        let notification = document.getElementById('login-notification');
        if (!notification) {
            // Tambahkan style untuk animasi
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }
                
                @keyframes scaleIn {
                    from { transform: scale(0.8); opacity: 0; }
                    to { transform: scale(1); opacity: 1; }
                }
                
                #notification-overlay {
                    animation: fadeIn 0.3s ease-out forwards;
                }
                
                #login-notification {
                    animation: scaleIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
                    transform-origin: center;
                }
            `;
            document.head.appendChild(style);
            
            // Buat overlay backdrop
            const overlay = document.createElement('div');
            overlay.id = 'notification-overlay';
            overlay.className = 'fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50';
            
            // Buat elemen notifikasi
            notification = document.createElement('div');
            notification.id = 'login-notification';
            notification.className = 'bg-white border rounded-2xl max-w-md w-96 p-8 relative flex flex-col items-center';
            notification.innerHTML = `
                <div class="w-20 h-20 rounded-full bg-red-200 flex items-center justify-center mb-6">
                    <svg class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <h2 class="text-xl font-medium text-center mb-6">Please login to access your wishlist</h2>
                <div class="w-full">
                    <a href="{{ route('shoes.login') }}" class="block w-full bg-blue-600 text-white py-3 rounded-3xl text-center font-medium hover:bg-blue-700 transition-colors">
                        Login
                    </a>
                </div>
            `;
            
            // Tambahkan notifikasi ke overlay
            overlay.appendChild(notification);
            
            // Tambahkan overlay ke body
            document.body.appendChild(overlay);
            
            // Tambahkan event listener untuk menutup saat klik overlay
            overlay.addEventListener('click', function(event) {
                if (event.target === overlay) {
                    closeNotification();
                }
            });
        }
    }
    
    function closeNotification() {
        const overlay = document.getElementById('notification-overlay');
        if (overlay) {
            // Animasi menutup
            overlay.style.animation = 'fadeIn 0.3s ease-in reverse forwards';
            const notification = document.getElementById('login-notification');
            if (notification) {
                notification.style.animation = 'scaleIn 0.3s ease-in reverse forwards';
            }
            
            // Hapus elemen setelah animasi selesai
            setTimeout(() => overlay.remove(), 300);
        }
    }
    
    function showLoginCartNotification() {
        // Cek apakah elemen notifikasi sudah ada
        let notification = document.getElementById('login-cart-notification');
        if (!notification) {
            // Tambahkan style untuk animasi jika belum ada
            if (!document.querySelector('style[data-id="notification-animations"]')) {
                const style = document.createElement('style');
                style.setAttribute('data-id', 'notification-animations');
                style.textContent = `
                    @keyframes fadeIn {
                        from { opacity: 0; }
                        to { opacity: 1; }
                    }
                    
                    @keyframes scaleIn {
                        from { transform: scale(0.8); opacity: 0; }
                        to { transform: scale(1); opacity: 1; }
                    }
                    
                    #notification-overlay {
                        animation: fadeIn 0.3s ease-out forwards;
                    }
                    
                    #login-cart-notification {
                        animation: scaleIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
                        transform-origin: center;
                    }
                `;
                document.head.appendChild(style);
            }
            
            // Buat overlay backdrop
            const overlay = document.createElement('div');
            overlay.id = 'notification-overlay';
            overlay.className = 'fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50';
            
            // Buat elemen notifikasi
            notification = document.createElement('div');
            notification.id = 'login-cart-notification';
            notification.className = 'bg-white border rounded-2xl max-w-md w-96 p-8 relative flex flex-col items-center';
            notification.innerHTML = `
                <div class="w-20 h-20 rounded-full bg-blue-200 flex items-center justify-center mb-6">
                    <svg class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h2 class="text-xl font-medium text-center mb-6">Please login to add items to your cart</h2>
                <div class="w-full">
                    <a href="{{ route('shoes.login') }}" class="block w-full bg-blue-600 text-white py-3 rounded-3xl text-center font-medium hover:bg-blue-700 transition-colors">
                        Login
                    </a>
                </div>
            `;
            
            // Tambahkan notifikasi ke overlay
            overlay.appendChild(notification);
            
            // Tambahkan overlay ke body
            document.body.appendChild(overlay);
            
            // Tambahkan event listener untuk menutup saat klik overlay
            overlay.addEventListener('click', function(event) {
                if (event.target === overlay) {
                    closeCartNotification();
                }
            });
        }
    }
    
    function closeCartNotification() {
        const overlay = document.getElementById('notification-overlay');
        if (overlay) {
            // Animasi menutup
            overlay.style.animation = 'fadeIn 0.3s ease-in reverse forwards';
            const notification = document.getElementById('login-cart-notification');
            if (notification) {
                notification.style.animation = 'scaleIn 0.3s ease-in reverse forwards';
            }
            
            // Hapus elemen setelah animasi selesai
            setTimeout(() => overlay.remove(), 300);
        }
    }
</script>