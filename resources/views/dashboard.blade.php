<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'My Account - STEP UP')

@section('content')
<div class="bg-white pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">My Account</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="md:col-span-1">
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="flex-shrink-0">
                            <div class="bg-blue-600 h-12 w-12 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-xl">{{ substr(Auth::guard('shoes')->user()->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-900 font-medium">{{ Auth::guard('shoes')->user()->name }}</p>
                            <p class="text-gray-500 text-sm">{{ Auth::guard('shoes')->user()->email }}</p>
                        </div>
                    </div>
                    
                    <nav class="space-y-1">
                        <button type="button" data-tab="dashboard-tab" class="tab-button flex items-center w-full px-3 py-2 bg-blue-50 text-blue-700 rounded-md font-medium">
                            <i class="fas fa-tachometer-alt mr-3 text-blue-500"></i>
                            Dashboard
                        </button>
                        <button type="button" data-tab="orders-tab" class="tab-button flex items-center w-full px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
                            <i class="fas fa-shopping-bag mr-3 text-gray-400"></i>
                            My Orders
                        </button>
                        <button type="button" data-tab="profile-tab" class="tab-button flex items-center w-full px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
                            <i class="fas fa-user mr-3 text-gray-400"></i>
                            Profile Information
                        </button>
                        <form method="POST" action="{{ route('shoes.logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
                                <i class="fas fa-sign-out-alt mr-3 text-gray-400"></i>
                                Logout
                            </button>
                        </form>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="md:col-span-3">
                <!-- Dashboard Tab -->
                <div id="dashboard-tab" class="tab-content bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden mb-8">
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                        <h2 class="text-lg font-medium text-gray-900">Dashboard</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                <div class="flex items-center">
                                    <div class="bg-blue-100 rounded-full p-3 mr-4">
                                        <i class="fas fa-shopping-bag text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Total Orders</p>
                                        <p class="text-xl font-bold text-gray-900">{{ Auth::guard('shoes')->user()->orders->count() }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                                <div class="flex items-center">
                                    <div class="bg-green-100 rounded-full p-3 mr-4">
                                        <i class="fas fa-check-circle text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Completed</p>
                                        <p class="text-xl font-bold text-gray-900">{{ Auth::guard('shoes')->user()->orders->where('status', 'delivered')->count() }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                                <div class="flex items-center">
                                    <div class="bg-yellow-100 rounded-full p-3 mr-4">
                                        <i class="fas fa-clock text-yellow-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Pending</p>
                                        <p class="text-xl font-bold text-gray-900">{{ Auth::guard('shoes')->user()->orders->whereIn('status', ['pending', 'processing', 'shipped'])->count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Account Information</h3>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <div class="flex flex-col sm:flex-row sm:justify-between">
                                    <div class="mb-4 sm:mb-0">
                                        <p class="text-sm text-gray-500">Member Since</p>
                                        <p class="text-gray-900">{{ Auth::guard('shoes')->user()->created_at->format('F d, Y') }}</p>
                                    </div>
                                    <div class="mb-4 sm:mb-0">
                                        <p class="text-sm text-gray-500">Email</p>
                                        <p class="text-gray-900">{{ Auth::guard('shoes')->user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Orders Tab -->
                <div id="orders-tab" class="tab-content hidden bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden mb-8">
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                        <h2 class="text-lg font-medium text-gray-900">My Orders</h2>
                    </div>
                    <div class="overflow-x-auto">
                        @if(Auth::guard('shoes')->user()->orders->count() > 0)
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order #</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach(Auth::guard('shoes')->user()->orders->sortByDesc('created_at') as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->order_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($order->status == 'pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                            @elseif($order->status == 'processing')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Processing</span>
                                            @elseif($order->status == 'shipped')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Shipped</span>
                                            @elseif($order->status == 'delivered')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Delivered</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('checkout.success', $order) }}" class="text-blue-600 hover:text-blue-900">View details</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center py-12">
                                <i class="fas fa-shopping-bag text-gray-300 text-4xl mb-3"></i>
                                <p class="text-gray-500">You haven't placed any orders yet</p>
                                <a href="{{ route('products.index') }}" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Start Shopping
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Profile Tab -->
                <div id="profile-tab" class="tab-content hidden bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden mb-8">
                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                        <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('shoes.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" id="name" name="name" value="{{ Auth::guard('shoes')->user()->name }}" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                    <input type="email" id="email" name="email" value="{{ Auth::guard('shoes')->user()->email }}" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                    <input type="password" id="password" name="password" placeholder="Leave blank to keep current password" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-3xl shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');
        
        // Function to activate a tab
        function activateTab(tabId) {
            // Hide all tab contents
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active class from all tab buttons
            tabButtons.forEach(button => {
                button.classList.remove('bg-blue-50', 'text-blue-700');
                button.classList.add('text-gray-700');
                button.querySelector('i').classList.remove('text-blue-500');
                button.querySelector('i').classList.add('text-gray-400');
            });
            
            // Show selected tab content
            const selectedContent = document.getElementById(tabId);
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
            }
            
            // Activate selected tab button
            const selectedButton = document.querySelector(`[data-tab="${tabId}"]`);
            if (selectedButton) {
                selectedButton.classList.remove('text-gray-700');
                selectedButton.classList.add('bg-blue-50', 'text-blue-700');
                selectedButton.querySelector('i').classList.remove('text-gray-400');
                selectedButton.querySelector('i').classList.add('text-blue-500');
            }
        }
        
        // Add click event listeners to tab buttons
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                activateTab(tabId);
            });
        });
        
        // Check if there's a tab parameter in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const tabParam = urlParams.get('tab');
        
        if (tabParam && document.getElementById(tabParam)) {
            activateTab(tabParam);
        } else {
            // Activate default tab (dashboard)
            activateTab('dashboard-tab');
        }
    });
</script>
@endsection