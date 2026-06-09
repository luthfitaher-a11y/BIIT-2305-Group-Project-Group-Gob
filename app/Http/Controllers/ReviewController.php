<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    // Show reviews for a product (filterable by star rating)
    public function index(Request $request, int $productId)
    {
        $product = Product::findOrFail($productId);
        $query   = $product->reviews()->with('user');

        if ($request->star && $request->star > 0) {
            $query->where('rating', $request->star);
        }

        $reviews = $query->latest()->get();
        return response()->json($reviews);
    }

    // Store a new review (only after order is delivered)
    public function store(Request $request, int $productId)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Check user has a delivered order containing this product
        $hasPurchased = Auth::user()->orders()
            ->where('status', 'delivered')
            ->whereHas('items', fn($q) => $q->where('product_id', $productId))
            ->exists();

        if (!$hasPurchased) {
            return back()->withErrors(['review' => 'You can only review products you have received.']);
        }

        // Prevent duplicate reviews
        $alreadyReviewed = Review::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->exists();

        if ($alreadyReviewed) {
            return back()->withErrors(['review' => 'You have already reviewed this product.']);
        }

        Review::create([
            'user_id'    => Auth::id(),
            'product_id' => $productId,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return back()->with('success', 'Thank you for your review!');
    }

    public function myReviews()
    {
    $reviews = \App\Models\Review::with('product')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

    return view('reviews.my', compact('reviews'));
    }
}