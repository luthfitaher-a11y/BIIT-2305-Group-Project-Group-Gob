@extends('layouts.app')
@section('title', 'Order Confirmed — Gob Sports')

@section('content')
<div class="success-page">
    <div class="s-confetti">🎉</div>
    <h2>Order Confirmed!</h2>
    <p class="s-sub">Thank you for shopping with Gob Sports. Your order is being processed.</p>

    {{-- Order receipt --}}
    <div class="order-receipt">
        <div class="or-title">Order #{{ $order->id }}</div>
        @foreach($order->items as $item)
            <div class="or-row">
                <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                <span>RM{{ $item->price * $item->quantity }}</span>
            </div>
        @endforeach
        <div class="or-row">
            <span>Shipping</span>
            <span>{{ $order->shipping_cost > 0 ? 'RM' . $order->shipping_cost : 'FREE' }}</span>
        </div>
        <div class="or-row total">
            <span>Total Paid</span>
            <span>RM{{ $order->total_amount + $order->shipping_cost }}</span>
        </div>
        <div style="margin-top:.75rem;font-size:12px;color:#777">
            Delivering to: {{ $order->shipping_address }}
        </div>
    </div>

    {{-- Delivery confirmation --}}
    @if($order->status !== 'delivered')
        <div class="delivery-card">
            <div class="dc-icon">📦</div>
            <h3>Mark as Received</h3>
            <p>Once your order arrives, confirm receipt to unlock the product review feature.</p>
            <form method="POST" action="{{ route('orders.received', $order->id) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="confirm-recv-btn">I Have Received My Order</button>
            </form>
        </div>
    @else
        {{-- Review forms (only after delivery confirmed) --}}
        <div class="sec-title" style="margin-bottom:1rem">Rate Your Purchase</div>
        @foreach($order->items as $item)
            <div class="rv-form-card">
                <div class="rv-fc-title">{{ $item->product->name }}</div>
                <form method="POST" action="{{ route('reviews.store', $item->product_id) }}">
                    @csrf
                    <div class="star-picker" id="stars-{{ $item->product_id }}">
                        @for($s = 1; $s <= 5; $s++)
                            <span data-star="{{ $s }}" onclick="setStar({{ $item->product_id }}, {{ $s }})">☆</span>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating-{{ $item->product_id }}" value="0">
                    <textarea class="rv-ta" name="comment"
                              placeholder="Share your experience with this product..."></textarea>
                    <button type="submit" class="rv-sub-btn">Submit Review</button>
                </form>
            </div>
        @endforeach
    @endif

    <a href="{{ route('home') }}" class="place-btn" style="display:block;text-align:center;text-decoration:none;margin-top:1rem">
        Continue Shopping
    </a>
</div>
@endsection