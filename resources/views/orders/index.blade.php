@extends('layouts.app')
@section('title', 'My Orders — Gob Sports')
@section('content')
<style>
.orders-wrap { max-width: 900px; margin: 2rem auto; padding: 0 1.5rem; }
.orders-back { display: inline-flex; align-items: center; gap: 6px; color: #777; font-size: 13px; font-weight: 600; text-decoration: none; margin-bottom: 1.25rem; }
.orders-back:hover { color: #111; }
.orders-title { font-size: 22px; font-weight: 800; margin-bottom: 1.5rem; border-left: 4px solid #e8c84a; padding-left: 10px; }

.order-card { background: #fff; border: 1px solid #e8e8e8; border-radius: 12px; margin-bottom: 1.25rem; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.05); }
.order-header { display: flex; justify-content: space-between; align-items: center; padding: 1rem 1.5rem; border-bottom: 1px solid #f0f0f0; }
.order-id { font-weight: 800; font-size: 15px; }
.order-date { color: #888; font-size: 13px; margin-top: 2px; }
.order-header-right { display: flex; align-items: center; gap: .75rem; }

.status-badge { padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; display: flex; align-items: center; gap: 5px; }
.status-pending   { background: #fff8e1; color: #b8860b; }
.status-processing{ background: #fff3e0; color: #e65c00; }
.status-delivered { background: #e8f5ee; color: #1a7a4a; }
.status-cancelled { background: #fdecea; color: #c0392b; }

.btn-cancel { border: 2px solid #e53e3e; background: #fff; color: #e53e3e; padding: 6px 16px; border-radius: 20px; font-size: 12px; font-weight: 700; cursor: pointer; }
.btn-cancel:hover { background: #e53e3e; color: #fff; }

.order-items { padding: 0 1.5rem; }
.order-item { display: flex; align-items: center; gap: 1rem; padding: .75rem 0; border-bottom: 1px solid #f8f8f8; }
.order-item:last-child { border-bottom: none; }
.oi-img { width: 44px; height: 44px; background: #f5f5f5; border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0; }
.oi-img img { max-width: 100%; max-height: 100%; object-fit: contain; }
.oi-name { flex: 1; font-weight: 600; font-size: 14px; }
.oi-qty { color: #888; font-size: 13px; margin-right: 1rem; }
.oi-price { font-weight: 700; font-size: 14px; }
.oi-arrow { color: #ccc; font-size: 13px; margin-left: .5rem; }

.order-footer { display: flex; justify-content: space-between; align-items: center; padding: .9rem 1.5rem; background: #fafafa; border-top: 1px solid #f0f0f0; }
.order-address { color: #777; font-size: 13px; display: flex; align-items: center; gap: 5px; }
.order-footer-right { display: flex; align-items: center; gap: 1rem; }
.order-total { font-weight: 800; font-size: 15px; }
.ship-free { color: #1a7a4a; font-size: 12px; font-weight: 700; margin-left: 6px; }
.ship-cost { color: #888; font-size: 12px; margin-left: 6px; }

.btn-confirm { border: 2px solid #1a7a4a; background: #fff; color: #1a7a4a; padding: 7px 18px; border-radius: 20px; font-size: 13px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 6px; }
.btn-confirm:hover { background: #1a7a4a; color: #fff; }
.received-label { color: #1a7a4a; font-weight: 700; font-size: 13px; display: flex; align-items: center; gap: 5px; }

/* Review section */
.review-section { border-top: 1px solid #f0f0f0; padding: 1.25rem 1.5rem; background: #fafffe; }
.review-section-title { font-size: 14px; font-weight: 700; margin-bottom: 1rem; color: #111; display: flex; align-items: center; gap: 6px; }
.review-item-block { background: #fff; border: 1px solid #eeeeee; border-radius: 10px; padding: 1rem; margin-bottom: .75rem; }
.review-item-block:last-child { margin-bottom: 0; }
.review-product-name { font-size: 13px; font-weight: 700; margin-bottom: .6rem; color: #333; }
.star-picker { display: flex; gap: 4px; font-size: 24px; cursor: pointer; margin-bottom: .6rem; }
.star-picker span { color: #ddd; transition: color .1s; user-select: none; }
.star-picker span.lit { color: #f5a623; }
.review-textarea { width: 100%; border: 1px solid #ddd; border-radius: 8px; padding: 9px 12px; font-size: 13px; outline: none; resize: vertical; font-family: inherit; min-height: 70px; box-sizing: border-box; }
.review-textarea:focus { border-color: #1a7a4a; }
.btn-submit-review { background: #111; color: #fff; border: none; padding: 9px 22px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; margin-top: .6rem; }
.btn-submit-review:hover { background: #333; }
.already-reviewed { color: #1a7a4a; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 5px; }

.orders-empty { text-align: center; padding: 4rem; background: #fff; border-radius: 12px; }
</style>

<div class="orders-wrap">
    <a href="{{ route('home') }}" class="orders-back">← Back to Home</a>
    <div class="orders-title">My Orders</div>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:10px 16px; border-radius:8px; margin-bottom:1rem;">{{ session('success') }}</div>
    @endif

    @forelse($orders as $order)
    <div class="order-card">

        {{-- Header --}}
        <div class="order-header">
            <div>
                <div class="order-id">Order #GS-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                <div class="order-date">Placed on {{ $order->created_at->format('Y-m-d') }}</div>
            </div>
            <div class="order-header-right">
                @php
                    $statusIcon = ['pending'=>'⏳','processing'=>'🔄','delivered'=>'✅','cancelled'=>'❌'][$order->status] ?? '📦';
                @endphp
                <span class="status-badge status-{{ $order->status }}">
                    {{ $statusIcon }} {{ ucfirst($order->status) }}
                </span>
                @if(in_array($order->status, ['pending','processing']))
                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="margin:0;">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn-cancel">Cancel Order</button>
                </form>
                @endif
            </div>
        </div>

        {{-- Items --}}
        <div class="order-items">
            @foreach($order->items as $item)
            <div class="order-item">
                <div class="oi-img">
                    @if($item->product->image)
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                    @else
                        <span style="font-size:24px;">{{ $item->product->emoji ?? '🏅' }}</span>
                    @endif
                </div>
                <div class="oi-name">{{ $item->product->name ?? 'Product' }}</div>
                <span class="oi-qty">x{{ $item->quantity }}</span>
                <span class="oi-price">RM{{ number_format($item->price * $item->quantity, 2) }}</span>
                <span class="oi-arrow">›</span>
            </div>
            @endforeach
        </div>

        {{-- Footer --}}
        <div class="order-footer">
            <div class="order-address">
                📍 {{ $order->shipping_address }}
            </div>
            <div class="order-footer-right">
                @if($order->status === 'pending' || $order->status === 'processing')
                <form action="{{ route('orders.received', $order->id) }}" method="POST" style="margin:0;">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn-confirm">🎁 Confirm Receipt</button>
                </form>
                @elseif($order->status === 'delivered')
                <span class="received-label">✓ Received</span>
                @endif
                <div class="order-total">
                    Total: RM{{ number_format($order->total_amount, 2) }}
                    @if($order->shipping_cost == 0)
                        <span class="ship-free">FREE SHIP</span>
                    @else
                        <span class="ship-cost">+RM{{ number_format($order->shipping_cost, 2) }} ship</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Review Section (only for delivered orders) --}}
        @if($order->status === 'delivered')
        <div class="review-section">
            <div class="review-section-title">⭐ Leave a Review</div>
            @foreach($order->items as $item)
            @php
                $alreadyReviewed = \App\Models\Review::where('user_id', Auth::id())
                    ->where('product_id', $item->product_id)
                    ->exists();
            @endphp
            <div class="review-item-block">
                <div class="review-product-name">{{ $item->product->name }}</div>
                @if($alreadyReviewed)
                    <div class="already-reviewed">✓ You've already reviewed this product</div>
                @else
                <form action="{{ route('reviews.store', $item->product_id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="rating" class="rating-input-{{ $item->product_id }}" value="0">
                    <div class="star-picker" data-product="{{ $item->product_id }}">
                        <span data-val="1">★</span>
                        <span data-val="2">★</span>
                        <span data-val="3">★</span>
                        <span data-val="4">★</span>
                        <span data-val="5">★</span>
                    </div>
                    <textarea name="comment" class="review-textarea" placeholder="Share your experience with this product..." required></textarea>
                    <button type="submit" class="btn-submit-review">Submit Review</button>
                </form>
                @endif
            </div>
            @endforeach
        </div>
        @endif

    </div>
    @empty
    <div class="orders-empty">
        <div style="font-size:48px;">📦</div>
        <p style="color:#888; margin-top:1rem;">You have no orders yet.</p>
        <a href="{{ route('home') }}" style="display:inline-block; margin-top:1rem; background:#111; color:#fff; padding:10px 24px; border-radius:8px; text-decoration:none; font-weight:700;">Start Shopping</a>
    </div>
    @endforelse
</div>

<script>
document.querySelectorAll('.star-picker').forEach(function(picker) {
    const productId = picker.dataset.product;
    const stars = picker.querySelectorAll('span');
    const input = document.querySelector('.rating-input-' + productId);

    stars.forEach(function(star) {
        star.addEventListener('mouseover', function() {
            const val = parseInt(this.dataset.val);
            stars.forEach(s => s.classList.toggle('lit', parseInt(s.dataset.val) <= val));
        });
        star.addEventListener('mouseout', function() {
            const current = parseInt(input.value);
            stars.forEach(s => s.classList.toggle('lit', parseInt(s.dataset.val) <= current));
        });
        star.addEventListener('click', function() {
            input.value = this.dataset.val;
            const val = parseInt(this.dataset.val);
            stars.forEach(s => s.classList.toggle('lit', parseInt(s.dataset.val) <= val));
        });
    });
});
</script>
@endsection