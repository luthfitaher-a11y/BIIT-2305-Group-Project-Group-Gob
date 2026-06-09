<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;

// ── AUTH (Public) ──────────────────────────────────────────────────────────
Route::get('/',        [AuthController::class, 'showLogin'])->name('auth.login');
Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
Route::get('/signup',  [AuthController::class, 'showSignup'])->name('auth.signup.page');
Route::post('/login',  [AuthController::class, 'login'])->name('auth.doLogin');
Route::post('/signup', [AuthController::class, 'signup'])->name('auth.signup');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/my-reviews', [ReviewController::class, 'myReviews'])->name('reviews.my');

// ── PROTECTED (Login Required) ─────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Home & Products
    Route::get('/home',          [ProductController::class, 'index'])->name('home');
    Route::get('/products',      [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

    // Cart
    Route::get('/cart',                    [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}',   [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{itemId}',  [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout & Orders
    Route::get('/checkout',               [OrderController::class, 'showCheckout'])->name('checkout.index');
    Route::post('/checkout',              [OrderController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/orders',                 [OrderController::class, 'index'])->name('orders.index');      // <-- ADDED
    Route::get('/orders/{id}/success',    [OrderController::class, 'success'])->name('orders.success');
    Route::patch('/orders/{id}/received', [OrderController::class, 'confirmReceived'])->name('orders.received');

    // Reviews
    Route::get('/reviews/{productId}',  [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews/{productId}', [ReviewController::class, 'store'])->name('reviews.store');

    // cancel order
    Route::patch('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});