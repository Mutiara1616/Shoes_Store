<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">STEP UP</a>
                </div>
                <div class="hidden md:ml-10 md:flex md:space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Home</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Men</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Women</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Kids</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Sale</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-gray-700 hover:text-blue-600">
                    <i class="fas fa-search text-xl"></i>
                </a>
                <a href="#" class="text-gray-700 hover:text-blue-600">
                    <i class="fas fa-shopping-bag text-xl"></i>
                </a>
                @if(Auth::guard('shoes')->check())
                    <div class="relative" x-data="{ open: false }">
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
                
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-700 hover:text-blue-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="md:hidden bg-white shadow-lg">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Home</a>
            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Men</a>
            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Women</a>
            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Kids</a>
            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">Sale</a>
        </div>
    </div>
</nav>