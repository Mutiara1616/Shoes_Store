<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Skincare Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <div class="w-full md:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <div class="text-center mb-10">
                    <h1 class="text-2xl font-bold text-gray-700">Skincare Shop</h1>
                </div>
                
                <div class="flex border-b border-gray-300 mb-6">
                    <a href="{{ route('skincare.login') }}" class="px-4 py-2 text-sm font-medium text-teal-600 border-b-2 border-teal-600">Login</a>
                    <a href="{{ route('skincare.register') }}" class="px-4 py-2 text-sm font-medium text-gray-500">Sign up</a>
                </div>
                
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('skincare.login.submit') }}">
                    @csrf
                    <div class="mb-4">
                        <div class="relative">
                            <input type="email" name="email" id="email" placeholder="Email or phone number" 
                                class="w-full px-4 py-2 border rounded-full bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500 pl-10" 
                                value="{{ old('email') }}" required>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="Password" 
                                class="w-full px-4 py-2 border rounded-full bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500 pl-10" required>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <a href="{{ route('skincare.password.request') }}" class="text-sm text-gray-500 hover:text-teal-600">Forgot your password?</a>
                    </div>
                    
                    <button type="submit" class="w-full bg-teal-500 text-white py-2 px-4 rounded-full hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50">
                        Login
                    </button>
                </form>
            </div>
        </div>
        
        <div class="hidden md:block md:w-1/2 bg-teal-100 relative">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="p-12">
                    <img src="{{ asset('images/skincare.jpg') }}" alt="Illustration" class="max-w-full h-auto">
                </div>
            </div>
        </div>
    </div>
</body>
</html>