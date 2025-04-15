<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'brands.name as brand_name'
            )
            ->where('products.is_active', 1)
            ->whereNull('products.deleted_at');
    
        if ($request->has('in_stock') && $request->in_stock == 1) {
            $query->where('products.stock', '>', 0);
        }

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'like', "%{$search}%")
                ->orWhere('products.description', 'like', "%{$search}%")
                ->orWhere('categories.name', 'like', "%{$search}%")
                ->orWhere('brands.name', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->has('category')) {
            $query->where('categories.slug', $request->input('category'));
        }

        // Brand filter
        if ($request->has('brand')) {
            $query->where('brands.slug', $request->input('brand'));
        }

        // Price sorting
        if ($request->has('sort')) {
            if ($request->input('sort') === 'price-low') {
                $query->orderBy('products.price', 'asc');
            } elseif ($request->input('sort') === 'price-high') {
                $query->orderBy('products.price', 'desc');
            } elseif ($request->input('sort') === 'newest') {
                $query->orderBy('products.created_at', 'desc');
            }
        } else {
            $query->orderBy('products.created_at', 'desc');
        }

        $products = $query->paginate(12);
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();

        return view('home', compact('products', 'categories', 'brands'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'brands.name as brand_name'
            )
            ->where('products.is_active', 1)
            ->where('categories.slug', $slug)
            ->whereNull('products.deleted_at');
            
        // Search functionality
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'like', "%{$search}%")
                  ->orWhere('products.description', 'like', "%{$search}%");
            });
        }
        
        // Brand filter
        if (request()->has('brand')) {
            $query->where('brands.slug', request()->input('brand'));
        }
        
        // Sorting
        if (request()->has('sort')) {
            if (request()->input('sort') === 'price-low') {
                $query->orderBy('products.price', 'asc');
            } elseif (request()->input('sort') === 'price-high') {
                $query->orderBy('products.price', 'desc');
            } elseif (request()->input('sort') === 'newest') {
                $query->orderBy('products.created_at', 'desc');
            }
        } else {
            $query->orderBy('products.created_at', 'desc');
        }

        $products = $query->paginate(12);
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();

        return view('products.category', compact('products', 'categories', 'brands', 'category'));
    }

    public function sale(Request $request)
    {
        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'brands.name as brand_name'
            )
            ->where('products.is_active', 1)
            ->whereNotNull('products.sale_price')
            ->whereRaw('products.sale_price < products.price')
            ->whereNull('products.deleted_at');
            
        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'like', "%{$search}%")
                  ->orWhere('products.description', 'like', "%{$search}%")
                  ->orWhere('categories.name', 'like', "%{$search}%")
                  ->orWhere('brands.name', 'like', "%{$search}%");
            });
        }
        
        // Category filter
        if ($request->has('category')) {
            $query->where('categories.slug', $request->input('category'));
        }
        
        // Brand filter
        if ($request->has('brand')) {
            $query->where('brands.slug', $request->input('brand'));
        }
        
        // Sorting
        if ($request->has('sort')) {
            if ($request->input('sort') === 'price-low') {
                $query->orderBy('products.sale_price', 'asc');
            } elseif ($request->input('sort') === 'price-high') {
                $query->orderBy('products.sale_price', 'desc');
            } elseif ($request->input('sort') === 'newest') {
                $query->orderBy('products.created_at', 'desc');
            }
        } else {
            $query->orderBy('products.created_at', 'desc');
        }

        $products = $query->paginate(12);
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();

        return view('products.sale', compact('products', 'categories', 'brands'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'brand'])
            ->where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', 1)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
    
    public function brand($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        
        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'brands.name as brand_name'
            )
            ->where('products.is_active', 1)
            ->where('brands.slug', $slug)
            ->whereNull('products.deleted_at');
            
        // Search functionality
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'like', "%{$search}%")
                  ->orWhere('products.description', 'like', "%{$search}%");
            });
        }
        
        // Category filter
        if (request()->has('category')) {
            $query->where('categories.slug', request()->input('category'));
        }
        
        // Sorting
        if (request()->has('sort')) {
            if (request()->input('sort') === 'price-low') {
                $query->orderBy('products.price', 'asc');
            } elseif (request()->input('sort') === 'price-high') {
                $query->orderBy('products.price', 'desc');
            } elseif (request()->input('sort') === 'newest') {
                $query->orderBy('products.created_at', 'desc');
            }
        } else {
            $query->orderBy('products.created_at', 'desc');
        }

        $products = $query->paginate(12);
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();

        return view('products.brand', compact('products', 'categories', 'brands', 'brand'));
    }
    
    public function newest(Request $request)
    {
        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'brands.name as brand_name'
            )
            ->where('products.is_active', 1)
            ->whereNull('products.deleted_at')
            ->orderBy('products.created_at', 'desc');
            
        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'like', "%{$search}%")
                  ->orWhere('products.description', 'like', "%{$search}%")
                  ->orWhere('categories.name', 'like', "%{$search}%")
                  ->orWhere('brands.name', 'like', "%{$search}%");
            });
        }
        
        // Category filter
        if ($request->has('category')) {
            $query->where('categories.slug', $request->input('category'));
        }
        
        // Brand filter
        if ($request->has('brand')) {
            $query->where('brands.slug', $request->input('brand'));
        }

        $products = $query->paginate(12);
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();

        return view('products.newest', compact('products', 'categories', 'brands'));
    }
    
    public function featured(Request $request)
    {
        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'brands.name as brand_name'
            )
            ->where('products.is_active', 1)
            ->where('products.is_featured', 1)
            ->whereNull('products.deleted_at');
            
        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'like', "%{$search}%")
                  ->orWhere('products.description', 'like', "%{$search}%")
                  ->orWhere('categories.name', 'like', "%{$search}%")
                  ->orWhere('brands.name', 'like', "%{$search}%");
            });
        }
        
        // Category filter
        if ($request->has('category')) {
            $query->where('categories.slug', $request->input('category'));
        }
        
        // Brand filter
        if ($request->has('brand')) {
            $query->where('brands.slug', $request->input('brand'));
        }
        
        // Sorting
        if ($request->has('sort')) {
            if ($request->input('sort') === 'price-low') {
                $query->orderBy('products.price', 'asc');
            } elseif ($request->input('sort') === 'price-high') {
                $query->orderBy('products.price', 'desc');
            } elseif ($request->input('sort') === 'newest') {
                $query->orderBy('products.created_at', 'desc');
            }
        } else {
            $query->orderBy('products.created_at', 'desc');
        }

        $products = $query->paginate(12);
        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();

        return view('products.featured', compact('products', 'categories', 'brands'));
    }
}