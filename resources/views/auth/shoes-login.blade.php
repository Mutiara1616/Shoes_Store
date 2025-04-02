<!-- resources/views/auth/shoes-login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - STEP UP</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f0f0;
        }
        
        .input-field {
            transition: border-color 0.3s ease;
        }
        
        .input-field:focus {
            border-color: #000;
        }
        
        .sign-up-btn {
            background-color: #000;
            transition: all 0.3s ease;
        }
        
        .sign-up-btn:hover {
            background-color: #333;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <!-- Menggunakan ukuran yang sama dengan register -->
        <div class="max-w-6xl w-full bg-white rounded-xl overflow-hidden shadow-xl flex">
            <!-- Form side -->
            <div class="w-full md:w-1/2 p-10">
                <div class="mb-6">
                    <div class="flex items-center">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.2 5H4.8C3.81 5 3 5.81 3 6.8V17.2C3 18.19 3.81 19 4.8 19H19.2C20.19 19 21 18.19 21 17.2V6.8C21 5.81 20.19 5 19.2 5Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3 7L12 13L21 7" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="ml-2 font-semibold">STEP UP</span>
                    </div>
                </div>

                <!-- Notifikasi sukses -->
                @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                    <div class="flex">
                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
                @endif
                
                <!-- Notifikasi error -->
                @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                    <div class="flex">
                        <svg class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
                @endif
                
                <div class="mb-5">
                    <h1 class="text-2xl font-semibold text-gray-900">Welcome back</h1>
                    <p class="mt-1 text-gray-600">Please enter your credentials to login</p>
                </div>
                
                <form method="POST" action="{{ route('shoes.login.submit') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email<span class="text-gray-400">*</span></label>
                        <input type="email" name="email" id="email" 
                               class="input-field w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none" 
                               placeholder="Enter your email" value="{{ old('email') }}" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password<span class="text-gray-400">*</span></label>
                        <input type="password" name="password" id="password" 
                               class="input-field w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none" 
                               placeholder="Enter your password" required>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                            </div>
                            <a href="{{ route('shoes.password.request') }}" class="text-sm text-gray-700 hover:text-black">Forgot password?</a>
                        </div>
                    </div>
                    
                    <div class="mt-5">
                        <button type="submit" class="sign-up-btn w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Sign In
                        </button>
                    </div>
                </form>
                
                <div class="mt-5 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account? <a href="{{ route('shoes.register') }}" class="text-gray-900 font-medium">Sign up</a>
                    </p>
                </div>
            </div>
            
            <!-- Right side: Image - sama persis dengan register -->
            <div class="hidden md:block md:w-1/2 relative">
                <img src="https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1025&q=80" 
                     alt="Shoes" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-20 flex flex-col justify-end p-10">
                    <h2 class="text-3xl font-bold text-white mb-2">Discovering the Best Footwear for Your Style</h2>
                    <p class="text-white text-opacity-80 mb-8">
                        Our practice is designing complete collections for exceptional comfort and style for every situation
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <div class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm px-4 py-2 rounded-full flex items-center">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                <circle cx="12" cy="12" r="10" stroke="white" stroke-width="2"/>
                                <path d="M8 12L11 15L16 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-white text-sm">100% Guarantee</span>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm px-4 py-2 rounded-full flex items-center">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                <path d="M5 16H19" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                <path d="M10 8L8 16" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                <path d="M16 8L14 16" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <span class="text-white text-sm">Free delivery worldwide</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>