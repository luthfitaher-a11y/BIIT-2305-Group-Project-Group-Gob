<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Home page — show all products with optional filters
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'category', 'reviews']);

        // Filter by sport (soccer, rugby, badminton)
        if ($request->sport && $request->sport !== 'all') {
            $query->where('sport', $request->sport);
        }

        // Filter by category (footwear, apparel, ball, equipment, acc)
        if ($request->category && $request->category !== 'all') {
            $query->whereHas('category', fn($q) => $q->where('name', $request->category));
        }

        // Filter by price range
        if ($request->price === 'low')  $query->where('price', '<', 100);
        if ($request->price === 'mid')  $query->whereBetween('price', [100, 500]);
        if ($request->price === 'high') $query->where('price', '>', 500);
        if ($request->price === 'sale') $query->whereNotNull('old_price');

        // Search by name or brand
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhereHas('brand', fn($q) => $q->where('name', 'like', '%' . $request->search . '%'));
        }

        // Sort
        match($request->sort) {
            'price-asc'  => $query->orderBy('price', 'asc'),
            'price-desc' => $query->orderBy('price', 'desc'),
            'rating'     => $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc'),
            default      => $query->latest(),
        };

        $products   = $query->get();
        $categories = Category::all();

        return view('home.index', compact('products', 'categories'));
    }

    // Product detail page
    public function show(int $id)
    {
        $product = Product::with(['brand', 'category', 'reviews.user'])->findOrFail($id);
        return view('products.show', compact('product'));
    }
}