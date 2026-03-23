<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Главная страница (берет последние 8 товаров)
    public function index()
    {
        $products = Product::with('brand')->latest()->take(8)->get();
        return view('index', compact('products'));
    }

    // Каталог товаров (с пагинацией)
    public function catalog(Request $request)
    {
        $products = Product::with('brand')->paginate(12);
        return view('products.index', compact('products'));
    }

    // Детальная страница товара
    public function show($id)
    {
        $product = Product::with('brand')->findOrFail($id);
        
        // Похожие товары (из того же бренда)
        $relatedProducts = Product::where('brand_id', $product->brand_id)
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
    }
}