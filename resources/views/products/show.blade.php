@extends('layouts.app')
@section('title', $product->name . ' — Gob Sports')

@section('content')
<div class="detail-page" style="max-width:1100px; margin:2rem auto; padding:0 1.5rem;">

    <a href="{{ route('home') }}" class="back-link" style="display:inline-block; margin-bottom:1.5rem; color:var(--primary); text-decoration:none;">← Back to Products</a>

    <div class="detail-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:2.5rem; background:#fff; border-radius:16px; padding:2rem; box-shadow:0 2px 16px rgba(0,0,0,.08);">

        {{-- Product Image --}}
        <div style="display:flex; align-items:center; justify-content:center; background:#f8f8f8; border-radius:12px; min-height:300px;">
    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-height:300px; max-width:100%; object-fit:contain;">
    @else
        <span style="font-size:120px;">{{ $product->emoji ?? '🏅' }}</span>
    @endif
    </div>

        {{-- Product Info --}}
        <div style="display:flex; flex-direction:column; gap:1rem;">
            <span style="font-size:12px; font-weight:700; text-transform:uppercase; color:#888;">{{ ucfirst($product->sport) }}</span>
            <div style="font-size:13px; font-weight:700; color:#aaa; letter-spacing:1px;">{{ $product->brand->name ?? '' }}</div>
            <h1 style="font-size:1.75rem; font-weight:800; margin:0;">{{ $product->name }}</h1>

            {{-- Rating --}}
            <div style="display:flex; align-items:center; gap:.5rem;">
                @php $avg = $product->reviews->avg('rating') ?? 0; @endphp
                <span style="color:#f5a623;">
                    @for($i=1;$i<=5;$i++)
                        {{ $i <= round($avg) ? '★' : '☆' }}
                    @endfor
                </span>
                <span style="color:#888; font-size:13px;">({{ $product->reviews->count() }} reviews)</span>
            </div>

            {{-- Price --}}
            <div style="display:flex; align-items:center; gap:1rem;">
                <span style="font-size:2rem; font-weight:800; color:#111;">RM{{ number_format($product->price, 2) }}</span>
                @if($product->old_price)
                    <span style="font-size:1.1rem; color:#aaa; text-decoration:line-through;">RM{{ number_format($product->old_price, 2) }}</span>
                @endif
            </div>

            <p style="color:#555; line-height:1.6;">{{ $product->description }}</p>

            {{-- Tags --}}
            @if($product->tags)
            <div style="display:flex; flex-wrap:wrap; gap:.5rem;">
                @foreach(is_array($product->tags) ? $product->tags : json_decode($product->tags, true) ?? [] as $tag)
                    <span style="background:#f0f0f0; padding:4px 10px; border-radius:20px; font-size:12px;">{{ $tag }}</span>
                @endforeach
            </div>
            @endif

            {{-- Add to Cart --}}
            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="margin-top:1rem;">
                @csrf
                <button type="submit" style="background:#111; color:#fff; border:none; padding:14px 32px; border-radius:10px; font-size:16px; font-weight:700; cursor:pointer; width:100%;">
                    Add to Cart
                </button>
            </form>
        </div>
    </div>

    {{-- Reviews --}}
    @if($product->reviews->count() > 0)
    <div style="margin-top:2.5rem; background:#fff; border-radius:16px; padding:2rem; box-shadow:0 2px 16px rgba(0,0,0,.08);">
        <h2 style="margin-bottom:1.5rem;">Customer Reviews</h2>
        @foreach($product->reviews as $review)
        <div style="border-bottom:1px solid #f0f0f0; padding:1rem 0;">
            <div style="display:flex; justify-content:space-between; margin-bottom:.4rem;">
                <strong>{{ $review->user->name ?? 'User' }}</strong>
                <span style="color:#888; font-size:12px;">{{ $review->created_at->format('d M Y') }}</span>
            </div>
            <div style="color:#f5a623; margin-bottom:.4rem;">
                @for($i=1;$i<=5;$i++) {{ $i <= $review->rating ? '★' : '☆' }} @endfor
            </div>
            <p style="color:#555; margin:0;">{{ $review->comment }}</p>
        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection