<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;


class OrderController extends Controller
{
    // Show the checkout page (3-step form)
    public function showCheckout()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cartItems = $cart->items()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
        $shipping = $subtotal >= 100 ? 0 : 15;
        $total = $subtotal + $shipping;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    public function index()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    // Place the order — save to DB, clear cart
    public function placeOrder(Request $request)
    {
        $request->validate([
            'first_name'     => 'required|string',
            'last_name'      => 'required|string',
            'address'        => 'required|string',
            'city'           => 'required|string',
            'postcode'       => 'required|string',
            'phone'          => 'required|string',
            'payment_method' => 'required|in:card,bank,ewallet',
        ]);

        $cart  = Cart::with('items.product')->where('user_id', Auth::id())->firstOrFail();
        $total = $cart->total();
        $ship  = $cart->shippingCost();

        // Create the order record
        $order = Order::create([
            'user_id'          => Auth::id(),
            'total_amount'     => $total,
            'shipping_cost'    => $ship,
            'status'           => 'pending',
            'shipping_address' => $request->first_name . ' ' . $request->last_name .
                                  ', ' . $request->address .
                                  ', ' . $request->city .
                                  ' ' . $request->postcode,
            'payment_method'   => $request->payment_method,
        ]);

        // Create order items from cart items
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->price,
            ]);
        }

        // Clear the cart
        $cart->items()->delete();

        return redirect()->route('orders.success', $order->id);
    }

    // Show the order success page
    public function success(int $id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('orders.success', compact('order'));
    }

    // Mark order as received — unlocks review form
    public function confirmReceived(int $id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $order->update(['status' => 'delivered']);
        return back()->with('success', 'Order marked as received. You can now leave a review!');
    }

    // cancel order
    public function cancel(int $id)
    {
    $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    if (in_array($order->status, ['pending', 'processing'])) {
        $order->update(['status' => 'cancelled']);
    }
    return back()->with('success', 'Order cancelled.');
    }
}