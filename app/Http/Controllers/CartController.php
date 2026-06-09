<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    // Show the cart page
    public function index()
{
    $cart = Auth::user()->cart;
    $cartItems = $cart ? $cart->items()->with('product')->get() : collect();
    $subtotal = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
    $shipping = $subtotal >= 100 ? 0 : 15;
    return view('cart.index', compact('cartItems', 'subtotal', 'shipping'));
}

    // Add a product to the cart
    public function add(Request $request, int $productId)
    {
        $product = Product::findOrFail($productId);
        $cart    = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $item = $cart->items()->where('product_id', $productId)->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'quantity'   => 1,
                'price'      => $product->price,
            ]);
        }

        return back()->with('success', $product->name . ' added to cart!');
    }

    // Update quantity of a cart item
    public function update(Request $request, int $itemId)
    {
        $item = CartItem::findOrFail($itemId);

        if ($request->quantity <= 0) {
            $item->delete();
        } else {
            $item->update(['quantity' => $request->quantity]);
        }

        return back();
    }

    // Remove an item from the cart
    public function remove(int $itemId)
    {
        CartItem::findOrFail($itemId)->delete();
        return back()->with('success', 'Item removed from cart.');
    }
}