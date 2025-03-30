<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard - STEP UP')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">My Account</h1>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <div class="p-6 text-gray-900">
                <p class="mb-4">Welcome back, <span class="font-medium">{{ Auth::guard('shoes')->user()->name }}</span>!</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">
                            <i class="fas fa-box-open mr-2 text-blue-500"></i> My Orders
                        </h3>
                        <p class="text-gray-600 mb-3">Track, return, or buy again.</p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">View Orders</a>
                    </div>
                    
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">
                            <i class="fas fa-heart mr-2 text-blue-500"></i> Wishlist
                        </h3>
                        <p class="text-gray-600 mb-3">Items you've saved for later.</p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">View Wishlist</a>
                    </div>
                    
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">
                            <i class="fas fa-user-cog mr-2 text-blue-500"></i> Account Settings
                        </h3>
                        <p class="text-gray-600 mb-3">Edit profile, change password.</p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection