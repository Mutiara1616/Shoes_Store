<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Skincare Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <h1 class="text-xl font-bold text-teal-600">Skincare Shop</h1>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <form method="POST" action="{{ route('skincare.logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-teal-600">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        
        <div class="py-10">
            <header>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                </div>
            </header>
            <main>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="bg-white overflow-hidden shadow rounded-lg p-6">
                        <p>Selamat datang, {{ Auth::guard('skincare')->user()?->name ?? 'Pengunjung' }}</p>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>