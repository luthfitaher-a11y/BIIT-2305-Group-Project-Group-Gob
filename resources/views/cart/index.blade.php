@extends('layouts.app')
@section('title', 'Cart — Gob Sports')

@section('content')
<div style="max-width:1100px; margin:2rem auto; padding:0 1.5rem;">

    <a href="{{ route('home') }}" style="color:#888; text-decoration:none; display:inline-block; margin-bottom:1.5rem;">← Continue Shopping</a>

    <h2 style="margin-bottom:1.5rem;">Shopping Cart</h2>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:10px 16px; border-radius:8px; margin-bottom:1rem;">{{ session('success') }}</div>
    @endif

    <div style="display:grid; grid-template-columns:1fr 340px; gap:2rem;">

        {{-- Cart Items --}}
        <div>
            @forelse($cartItems as $item)
            <div style="display:flex; align-items:center; gap:1rem; background:#fff; border-radius:12px; padding:1.25rem; margin-bottom:1rem; box-shadow:0 2px 8px rgba(0,0,0,.06);">
                <div style="width:70px; height:70px; background:#f5f5f5; border-radius:8px; display:flex; align-items:center; justify-content:center; overflow:hidden; flex-shrink:0;">
                    @if($item->product->image)
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="max-width:100%; max-height:100%; object-fit:contain;">
                    @else
                        <span style="font-size:36px;">{{ $item->product->emoji ?? '🏅' }}</span>
                    @endif
                </div>
                <div style="flex:1;">
                    <div style="font-weight:700; font-size:15px;">{{ $item->product->name }}</div>
                    <div style="color:#888; font-size:13px;">RM{{ number_format($item->product->price, 2) }} each</div>
                </div>
                <div style="display:flex; align-items:center; gap:.5rem;">
                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                        <button type="submit" style="width:30px; height:30px; border-radius:50%; border:1px solid #ddd; background:#fff; cursor:pointer; font-size:16px;">−</button>
                    </form>
                    <span style="width:30px; text-align:center; font-weight:700;">{{ $item->quantity }}</span>
                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                        <button type="submit" style="width:30px; height:30px; border-radius:50%; border:1px solid #ddd; background:#fff; cursor:pointer; font-size:16px;">+</button>
                    </form>
                </div>
                <div style="font-weight:800; font-size:16px; min-width:80px; text-align:right;">RM{{ number_format($item->product->price * $item->quantity, 2) }}</div>
                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" style="background:none; border:none; color:#aaa; cursor:pointer; font-size:18px;">✕</button>
                </form>
            </div>
            @empty
            <div style="text-align:center; padding:4rem; background:#fff; border-radius:12px;">
                <div style="font-size:48px;">🛒</div>
                <p style="color:#888; margin-top:1rem;">Your cart is empty.</p>
                <a href="{{ route('home') }}" style="display:inline-block; margin-top:1rem; background:#111; color:#fff; padding:10px 24px; border-radius:8px; text-decoration:none;">Start Shopping</a>
            </div>
            @endforelse
        </div>

        {{-- Order Summary --}}
        @if($cartItems->count() > 0)
        <div style="background:#fff; border-radius:12px; padding:1.5rem; box-shadow:0 2px 8px rgba(0,0,0,.06); height:fit-content;">
            <h3 style="margin-bottom:1.25rem;">Order Summary</h3>
            <div style="display:flex; justify-content:space-between; margin-bottom:.75rem;">
                <span>Subtotal</span><span>RM{{ number_format($subtotal, 2) }}</span>
            </div>
            <div style="display:flex; justify-content:space-between; margin-bottom:.75rem;">
                <span>Shipping</span>
                <span>{{ $shipping == 0 ? 'FREE' : 'RM' . number_format($shipping, 2) }}</span>
            </div>
            <div style="display:flex; justify-content:space-between; font-weight:800; font-size:18px; border-top:2px solid #f0f0f0; padding-top:.75rem; margin-top:.75rem;">
                <span>Total</span><span>RM{{ number_format($subtotal + $shipping, 2) }}</span>
            </div>
            @if($subtotal < 100)
            <div style="background:#fff8e1; color:#856404; padding:8px 12px; border-radius:8px; font-size:13px; margin-top:1rem;">
                Add RM{{ number_format(100 - $subtotal, 2) }} more for free shipping!
            </div>
            @else
            <div style="background:#d4edda; color:#155724; padding:8px 12px; border-radius:8px; font-size:13px; margin-top:1rem;">
                🎉 You qualify for free shipping!
            </div>
            @endif
            <a href="{{ route('checkout.index') }}" style="display:block; text-align:center; background:#111; color:#fff; padding:14px; border-radius:10px; text-decoration:none; font-weight:700; margin-top:1.25rem;">
                Proceed to Checkout →
            </a>
        </div>
        @endif

    </div>
</div>
@endsection