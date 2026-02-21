<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::take(3)->get();
        return view('home', compact('featuredProducts'));
    }

    public function catalog(Request $request)
    {
        $query = Product::query();

        if ($request->has('category') && $request->category != 'Semua') {
            $query->where('category', $request->category);
        }

        $products = $query->get();
        $categories = Product::distinct()->pluck('category');

        return view('catalog', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('product-detail', compact('product', 'relatedProducts'));
    }
}
