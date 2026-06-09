@extends('layouts.app')
@section('title', 'Home — Gob Sports')

@section('content')

{{-- ── HERO ── --}}
<div class="hero">
    <div class="hero-inner">
        <div class="hero-text">
            <div class="eyebrow">Malaysia's Sports Gear Store</div>
            <h1>Play at your <span>best</span> level</h1>
            <p>Discover pro-quality equipment for Soccer, Rugby, and Badminton.</p>
            <div class="hero-btns">
                <a href="#shop" class="btn-hero primary">Shop Now</a>
                <a href="{{ route('home', ['price' => 'sale']) }}" class="btn-hero outline">View Sales</a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat"><div class="num">25+</div><div class="lbl">Products</div></div>
                <div class="hero-stat"><div class="num">3</div><div class="lbl">Sports</div></div>
                <div class="hero-stat"><div class="num">RM15</div><div class="lbl">Flat Shipping</div></div>
                <div class="hero-stat"><div class="num">14</div><div class="lbl">Day Returns</div></div>
            </div>
        </div>
        <div class="hero-right">
            <a class="sport-tile featured" href="{{ route('home', ['sport' => 'soccer']) }}">
                <div class="icon">⚽</div><div class="label">Soccer</div>
            </a>
            <a class="sport-tile" href="{{ route('home', ['sport' => 'rugby']) }}">
                <div class="icon">🏉</div><div class="label">Rugby</div>
            </a>
            <a class="sport-tile" href="{{ route('home', ['sport' => 'badminton']) }}">
                <div class="icon">🏸</div><div class="label">Badminton</div>
            </a>
        </div>
    </div>
</div>

{{-- ── SHOP SECTION ── --}}
<div class="main-content" id="shop">

    {{-- Category filter --}}
    <div class="sec-title">Browse Categories</div>
    <div class="cat-grid">
        @foreach(['all','footwear','apparel','ball','equipment','acc'] as $cat)
            <a class="cat-tile {{ request('category', 'all') === $cat ? 'active' : '' }}"
               href="{{ route('home', array_merge(request()->query(), ['category' => $cat])) }}">
                <div class="cat-ico">{{ ['all'=>'🏪','footwear'=>'👟','apparel'=>'👕','ball'=>'⚽','equipment'=>'🏸','acc'=>'🎒'][$cat] }}</div>
                <div class="cat-name">{{ ucfirst($cat) }}</div>
            </a>
        @endforeach
    </div>

    {{-- Sport & price filters --}}
    <div class="sec-title" style="margin-top:2rem">All Products</div>
    <div class="sport-filter">
        @foreach(['all'=>'🏆 All Sports','soccer'=>'⚽ Soccer','rugby'=>'🏉 Rugby','badminton'=>'🏸 Badminton'] as $val => $label)
            <a class="sf-tab {{ request('sport','all') === $val ? 'active' : '' }}"
               href="{{ route('home', array_merge(request()->query(), ['sport' => $val])) }}">{{ $label }}</a>
        @endforeach
    </div>
    <div class="filter-row">
        @foreach(['all'=>'All Prices','low'=>'Under RM100','mid'=>'RM100–RM500','high'=>'RM500+','sale'=>'🔥 Sale'] as $val => $label)
            <a class="f-chip {{ request('price','all') === $val ? 'active' : '' }}"
               href="{{ route('home', array_merge(request()->query(), ['price' => $val])) }}">{{ $label }}</a>
        @endforeach
        <form method="GET" action="{{ route('home') }}" style="margin-left:auto">
            @foreach(request()->except('sort') as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <select name="sort" class="f-sort" onchange="this.form.submit()">
                <option value="default" {{ request('sort') === 'default' ? 'selected' : '' }}>Recommended</option>
                <option value="price-asc" {{ request('sort') === 'price-asc' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price-desc" {{ request('sort') === 'price-desc' ? 'selected' : '' }}>Price: High to Low</option>
                <option value="rating" {{ request('sort') === 'rating' ? 'selected' : '' }}>Top Rated</option>
            </select>
        </form>
    </div>

    {{-- Product grid --}}
    <div class="prod-grid">
        @forelse($products as $product)
            <a class="prod-card" href="{{ route('products.show', $product->id) }}">
                <div class="pc-img {{ $product->sport === 'rugby' ? 'rugby-bg' : ($product->sport === 'badminton' ? 'badminton-bg' : '') }}">
                    @if($product->badge)
                        <span class="pc-badge {{ $product->badge }}">{{ $product->badge }}</span>
                    @endif
                    <span class="sport-pill {{ $product->sport }}">{{ ucfirst($product->sport) }}</span>
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}" style="max-height:120px;object-fit:contain">
                </div>
                <div class="pc-body">
                    <div class="pc-brand">{{ $product->brand->name }}</div>
                    <div class="pc-name">{{ $product->name }}</div>
                    <div class="pc-stars">
                        <span class="pc-stars-val">
                            {{ str_repeat('★', (int)$product->averageRating()) }}{{ str_repeat('☆', 5 - (int)$product->averageRating()) }}
                        </span>
                        <span class="pc-rv-cnt">({{ $product->reviews->count() }})</span>
                    </div>
                    <div class="pc-foot">
                        <div>
                            <span class="pc-price">RM{{ $product->price }}</span>
                            @if($product->old_price)
                                <span class="pc-old">RM{{ $product->old_price }}</span>
                            @endif
                        </div>
                        {{-- Add to cart (POST form) --}}
                        <form method="POST" action="{{ route('cart.add', $product->id) }}"
                              onclick="event.stopPropagation()">
                            @csrf
                            <button type="submit" class="pc-add">+</button>
                        </form>
                    </div>
                </div>
            </a>
        @empty
            <p style="grid-column:1/-1;text-align:center;color:#777;padding:3rem">
                No products found. Try a different filter.
            </p>
        @endforelse
    </div>

</div>
@endsection