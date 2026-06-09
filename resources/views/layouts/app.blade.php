<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gob Sports')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    html.preload { visibility: hidden; }
    </style>
    <script>
        document.documentElement.classList.add('preload');
    </script>
</head>
<body>
<script>document.documentElement.classList.add('preload');</script>
{{-- ── HEADER ── --}}
<header class="site-header">
    <div class="header-inner" style="display:flex; align-items:center; justify-content:space-between; gap:1rem; padding:0.75rem 1.5rem;">
        <a href="{{ route('home') }}" class="site-logo"><span>Gob</span> Sports</a>

        <form action="{{ route('products.index') }}" method="GET" class="header-search">
            <span class="search-ico">🔍</span>
            <input type="text" name="search" placeholder="Search products, brands..."
                   value="{{ request('search') }}">
        </form>

        <div class="header-actions">
            {{-- User dropdown --}}
            <div class="user-dd">
                <button class="h-btn" id="userMenuBtn">
                    {{ substr(Auth::user()->name, 0, 1) }} {{ explode(' ', Auth::user()->name)[0] }} ▾
                </button>
                <div class="user-menu" id="userMenu">
                    <div class="um-head">
                        <div class="um-name">{{ Auth::user()->name }}</div>
                        <div class="um-email">{{ Auth::user()->email }}</div>
                    </div>
                    <a class="um-item" href="{{ route('orders.index') }}">📦 My Orders</a>
                    <a class="um-item" href="{{ route('reviews.my') }}">⭐ My Reviews</a>
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button type="submit" class="um-item danger">🚪 Log Out</button>
                    </form>
                </div>
            </div>

            {{-- Cart button --}}
            <a href="{{ route('cart.index') }}" class="cart-ico-btn">
                🛒 Cart
                <span class="cart-badge">{{ Auth::user()->cart?->items->sum('quantity') ?? 0 }}</span>
            </a>
        </div>
    </div>

    {{-- ── NAVIGATION ── --}}
    <nav class="site-nav" style="display:flex; flex-direction:row; align-items:center; gap:1.5rem; padding:0.5rem 1.5rem;">
        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
           href="{{ route('home') }}">Home</a>
        <a class="nav-link {{ request('sport') === 'soccer' ? 'active' : '' }}"
           href="{{ route('home', ['sport' => 'soccer']) }}">⚽ Soccer</a>
        <a class="nav-link {{ request('sport') === 'rugby' ? 'active' : '' }}"
           href="{{ route('home', ['sport' => 'rugby']) }}">🏉 Rugby</a>
        <a class="nav-link {{ request('sport') === 'badminton' ? 'active' : '' }}"
           href="{{ route('home', ['sport' => 'badminton']) }}">🏸 Badminton</a>
        <a class="nav-link {{ request('price') === 'sale' ? 'active' : '' }}"
           href="{{ route('home', ['price' => 'sale']) }}">🔥 Sales</a>
    </nav>
    <style>
    .user-dd { position: relative; }
    #userMenu { 
        display: none; 
        position: absolute; 
        right: 0; 
        top: 100%; 
        background: #fff; 
        border-radius: 10px; 
        box-shadow: 0 4px 20px rgba(0,0,0,.15); 
        min-width: 200px; 
        z-index: 999;
        padding: 8px 0;
    }
    .um-head { padding: 12px 16px; border-bottom: 1px solid #f0f0f0; }
    .um-name { font-weight: 700; }
    .um-email { color: #888; font-size: 13px; }
    .um-item { display: block; padding: 10px 16px; text-decoration: none; color: #111; cursor: pointer; background: none; border: none; width: 100%; text-align: left; font-size: 14px; }
    .um-item:hover { background: #f5f5f5; }
    .um-item.danger { color: #e53e3e; }
    </style>
</header>

{{-- ── PAGE CONTENT ── --}}
<main>
    

    @yield('content')
</main>

<footer>
    © 2026 <strong>Gob Sports</strong>
</footer>

<script>
    history.scrollRestoration = 'manual';

    window.addEventListener('beforeunload', function() {
        sessionStorage.setItem('scrollY', window.scrollY);
    });

    window.addEventListener('load', function() {
        const saved = sessionStorage.getItem('scrollY');
        if (saved) {
            window.scrollTo(0, parseInt(saved));
            sessionStorage.removeItem('scrollY');
        }
        document.documentElement.classList.remove('preload');
    });

    const btn = document.getElementById('userMenuBtn');
    const menu = document.getElementById('userMenu');
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });
    document.addEventListener('click', function() {
        menu.style.display = 'none';
    });
</script>
</body>
</html>