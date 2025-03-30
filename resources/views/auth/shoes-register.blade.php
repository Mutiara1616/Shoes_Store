<!-- resources/views/auth/shoes-register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - STEP UP</title>
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
        
        .image-side {
            background-image: url('https://images.unsplash.com/photo-1549298916-b41d501d3772?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1112&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-6xl w-full bg-white rounded-xl overflow-hidden shadow-xl flex">
            <!-- Left side: register form -->
            <div class="w-full md:w-1/2 p-10 md:p-16">
                <div class="mb-10">
                    <div class="flex items-center">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.2 5H4.8C3.81 5 3 5.81 3 6.8V17.2C3 18.19 3.81 19 4.8 19H19.2C20.19 19 21 18.19 21 17.2V6.8C21 5.81 20.19 5 19.2 5Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3 7L12 13L21 7" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="ml-2 font-semibold">STEP UP</span>
                    </div>
                </div>
                
                <div class="mb-8">
                    <h1 class="text-2xl font-semibold text-gray-900">Create your account</h1>
                    <p class="mt-2 text-gray-600">Please fill in your information</p>
                </div>
                
                <form method="POST" action="{{ route('shoes.register.submit') }}">
                    @csrf
                    
                    <div class="mb-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name<span class="text-gray-400">*</span></label>
                        <input type="text" name="name" id="name" 
                               class="input-field w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none" 
                               placeholder="Enter your name" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email<span class="text-gray-400">*</span></label>
                        <input type="email" name="email" id="email" 
                               class="input-field w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none" 
                               placeholder="Enter your email" value="{{ old('email') }}" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password<span class="text-gray-400">*</span></label>
                        <input type="password" name="password" id="password" 
                               class="input-field w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none" 
                               placeholder="Enter your password" required>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password<span class="text-gray-400">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="input-field w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none" 
                               placeholder="Confirm your password" required>
                    </div>
                    
                    <div>
                        <button type="submit" class="sign-up-btn w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Sign Up
                        </button>
                    </div>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? <a href="{{ route('shoes.login') }}" class="text-gray-900 font-medium">Log in</a>
                    </p>
                </div>
            </div>
            
            <!-- Right side: Static image with content -->
            <div class="hidden md:block md:w-1/2 relative image-side">
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