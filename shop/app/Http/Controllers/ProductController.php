<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('brand')->latest()->take(8)->get();
        return view('index', compact('products'));
    }

    public function catalog(Request $request)
    {
        $query = Product::with('brand');
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('brand')) {
            $query->whereIn('brand_id', $request->brand);
        }
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->latest();
        }
        
        $products = $query->paginate(12)->withQueryString();
        
        $brands = Brand::all();
        $categories = Category::all();
        
        return view('products.index', compact('products', 'brands', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('brand')->findOrFail($id);
        
        $relatedProducts = Product::where('brand_id', $product->brand_id)
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
    }
}