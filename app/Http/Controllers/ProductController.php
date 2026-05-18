<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home()
    {
        $newArrivals = Product::orderByDesc('created_at')->take(4)->get();
        $bestSellers = Product::orderByDesc('sold_count')->take(4)->get();

        return view('home', compact('newArrivals', 'bestSellers'));
    }

    public function index(Request $request, string $categorySlug)
    {
        $categories = Category::all();

        $query = Product::with('category');

        if ($categorySlug === 'all') {
            $currentCategory = 'ALL PRODUCTS';
        } else {
            $category = Category::where('slug', $categorySlug)->firstOrFail();
            $query->where('category_id', $category->id);
            $currentCategory = strtoupper($category->name);
        }

        if ($request->filled('q')) {
            $q = addcslashes(trim($request->q), '%_\\');
            $query->where('name', 'like', '%'.$q.'%');
        }

        $sort = $request->query('sort', 'newest');
        match ($sort) {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'name_asc' => $query->orderBy('name'),
            'name_desc' => $query->orderByDesc('name'),
            'popular' => $query->orderByDesc('sold_count'),
            default => $query->orderByDesc('created_at'),
        };

        $products = $query->paginate(12)->withQueryString();

        return view('collection.index', compact('products', 'categories', 'currentCategory', 'categorySlug'));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->orderByDesc('sold_count')
            ->take(8)
            ->get();

        return view('product.show', compact('product', 'relatedProducts'));
    }
}
