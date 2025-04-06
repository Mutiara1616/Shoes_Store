<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil produk yang bertanda featured dan aktif
        $featuredProducts = Product::where('is_featured', true)
                               ->where('is_active', true)
                               ->latest()
                               ->take(4)
                               ->get();
        
        return view('home', compact('featuredProducts'));
    }
}