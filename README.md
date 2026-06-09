# Gob Sports

# Gob Sports - Sports Equipment E-Commerce System

## Group Information

**Group Name**: Gob
**Section**: (Your Section Number)

**Group Members**:
| No | Name | Matric No |
|----|------|-----------|
| 1 | TAHER MUHAMMAD LUTHFIRRAHMAN | 2413807 |
| 2 | MUSA SUGIMOTO | 2418135 |
| 3 | RAYAN RAVA AHIMSA NABIL AR | 2416883 |
| 4 | ADAM ZHARFAN BIN IZAHA | 2417003 |
| 5 | MUHAMMAD KHAIRUL IKHWAN BIN ABD HALIM | 2417367 |

---

## Project Overview

**Introduction:**
Gob Sports is a web-based sports equipment e-commerce system developed using the Laravel framework. The application allows users to browse and purchase sports equipment for Soccer, Rugby, and Badminton. Users can filter products by sport, category, and price range, manage their shopping cart, complete a multi-step checkout process, track their orders, and leave product reviews after receiving their purchases.

---

## Project Objectives

- **Primary Goal:** Create a fully functional sports equipment online store with product browsing, cart management, and order processing
- **Technical Goal:** Implement Laravel MVC architecture with full CRUD operations and user authentication
- **User Experience Goal:** Provide an intuitive, responsive interface for browsing and purchasing sports products
- **Business Goal:** Enable efficient order management, product filtering, and customer review system

---

## Target Users

- **Customers:** Sports enthusiasts looking to purchase equipment online
- **Administrators:** System managers who manage products and orders

---

## Features and Functionalities

### Customer Features

- **User Registration & Login:** Secure account creation and authentication
- **Product Browsing:** Browse all products with sport, category, and price filters
- **Search:** Search products by name or brand
- **Product Detail:** View full product details, description, ratings, and reviews
- **Shopping Cart:** Add/remove items, modify quantities, view total cost
- **Free Shipping:** Automatic free shipping on orders above RM100
- **3-Step Checkout:** Shipping information → Payment method → Order review
- **Payment Methods:** Credit Card, Online Banking, and e-Wallet options
- **Order Management:** View all past orders with status tracking
- **Order Actions:** Confirm receipt and cancel pending orders
- **Product Reviews:** Leave star ratings and comments after receiving orders
- **My Reviews:** View all submitted reviews in one place

---

## Technical Implementation

### Technology Stack

- **Backend Framework:** Laravel 13.x
- **Frontend:** Blade Templates with custom CSS and JavaScript
- **Database:** MySQL
- **Authentication:** Laravel Auth Middleware
- **Image Storage:** Laravel File Storage
- **Build Tool:** Vite
- **Development Environment:** PHP 8.5

### Database Design

**Database Schema Overview:**
Our database consists of 9 main tables designed to handle users, products, cart, orders, and reviews.

**Core Tables:**
- `users` — Customer accounts
- `products` — Product details with sport, category, price, image
- `categories` — Product categories (Footwear, Apparel, Ball, Equipment, Accessories)
- `brands` — Product brands
- `carts` — User shopping carts
- `cart_items` — Individual items in each cart
- `orders` — Placed orders with shipping and payment info
- `order_items` — Individual items within each order
- `reviews` — Product reviews submitted by users

**Key Relationships:**
- Users can have one Cart (One-to-One)
- Carts can have multiple Cart Items (One-to-Many)
- Users can have multiple Orders (One-to-Many)
- Orders can have multiple Order Items (One-to-Many)
- Users can have multiple Reviews (One-to-Many)
- Products can have multiple Reviews (One-to-Many)

### Laravel Components Implementation

**Routes (web.php)**

```php
// Authentication Routes
Route::get('/',        [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login',  [AuthController::class, 'login'])->name('auth.doLogin');
Route::post('/signup', [AuthController::class, 'signup'])->name('auth.signup');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Protected Routes (auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/home',          [ProductController::class, 'index'])->name('home');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/checkout',      [OrderController::class, 'showCheckout'])->name('checkout.index');
    Route::post('/checkout',     [OrderController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/orders',        [OrderController::class, 'index'])->name('orders.index');
    Route::post('/reviews/{productId}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/my-reviews',    [ReviewController::class, 'myReviews'])->name('reviews.my');
});
```

**Controllers**

*Main Controllers Implemented:*

1. **AuthController** — Handles user registration, login, and logout
2. **ProductController** — Manages product listing with filters and product detail page
3. **CartController** — Handles cart operations (add, update quantity, remove)
4. **OrderController** — Processes checkout, order placement, confirmation, and cancellation
5. **ReviewController** — Manages product review submission and user review listing

**Models and Relationships**

```php
// User Model
class User extends Authenticatable {
    public function cart() {
        return $this->hasOne(Cart::class);
    }
    public function orders() {
        return $this->hasMany(Order::class);
    }
    public function reviews() {
        return $this->hasMany(Review::class);
    }
}

// Product Model
class Product extends Model {
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function brand() {
        return $this->belongsTo(Brand::class);
    }
    public function reviews() {
        return $this->hasMany(Review::class);
    }
}

// Order Model
class Order extends Model {
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}
```

**Views and User Interface**

*Blade Templates Structure:*
- `layouts/app.blade.php` — Main application layout with header and navigation
- `auth/login.blade.php` — Login and signup page
- `home/index.blade.php` — Homepage with hero section and product grid
- `products/show.blade.php` — Individual product detail page
- `cart/index.blade.php` — Shopping cart page
- `checkout/index.blade.php` — 3-step checkout process
- `orders/index.blade.php` — My orders page with review functionality
- `orders/success.blade.php` — Order success confirmation page
- `reviews/my.blade.php` — My reviews page

*Design Features:*
- **Colour Scheme:** Dark black header with yellow accents and clean white content areas
- **Navigation:** Sticky header with sport-based nav links and user dropdown menu
- **Interactive Elements:** AJAX add-to-cart, star rating picker, 3-step checkout wizard
- **Product Images:** Real product images stored via Laravel storage

---

## User Authentication System

### Authentication Features
- **Registration System:** Name, email, password confirmation
- **Login System:** Secure authentication with session management
- **Logout:** Session invalidation and token regeneration
- **Middleware Protection:** All product, cart, order, and review routes are protected

### Security Measures
- Password encryption using Laravel's built-in hashing (bcrypt)
- CSRF protection on all forms
- Input validation on all form submissions
- Middleware protection for authenticated routes

---

## Installation and Setup Instructions

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js and NPM
- MySQL
- XAMPP or Laravel Herd

### Step-by-Step Installation

**1. Clone the Repository**
```bash
git clone https://github.com/luthfitaher-a11y/BIIT-2305-Group-Project-Group-Gob.git
cd BIIT-2305-Group-Project-Group-Gob
```

**2. Install Dependencies**
```bash
composer install
npm install
```

**3. Environment Configuration**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Database Setup**
```bash
# Configure database credentials in .env file
php artisan migrate
php artisan db:seed
php artisan storage:link
```

**5. Start Development Server**
```bash
php artisan serve
npm run dev
```

---

## Challenges Faced and Solutions

### Challenge 1: Dropdown Menu Not Working
- **Problem:** The user dropdown JavaScript was placed in `<head>` before the DOM elements existed
- **Solution:** Moved the script to the bottom of the layout file before `</body>`

### Challenge 2: Page Scrolling to Top on Filter/Cart Actions
- **Problem:** Every filter click and add-to-cart action caused the page to reload and scroll to the top
- **Solution:** Added `#shop` anchor to filter links and implemented AJAX for add-to-cart to prevent full page reload

### Challenge 3: Product Images Not Displaying
- **Problem:** Product images were stored with spaces in filenames causing URL issues
- **Solution:** Renamed files consistently and used Laravel's `asset('storage/')` helper for correct path resolution

### Challenge 4: 3-Step Checkout Implementation
- **Problem:** Building a multi-step form without extra routes or page reloads
- **Solution:** Used JavaScript to show/hide step sections and validate each step before proceeding

---

## Future Enhancements

- **Payment Gateway Integration:** Real payment processing via Stripe or PayPal
- **Admin Dashboard:** Product and order management panel for administrators
- **Real-time Notifications:** Order status push notifications
- **Wishlist Feature:** Save products for later
- **Mobile App:** Native iOS and Android application

---

## Learning Outcomes

### Technical Skills Gained
- **Laravel Framework:** MVC architecture, Eloquent ORM, Blade templating
- **Database Design:** Relational schema design with foreign keys and relationships
- **Authentication:** Session-based auth with middleware protection
- **Frontend Development:** Custom CSS, JavaScript, AJAX interactions
- **Version Control:** Git and GitHub for collaborative development

### Soft Skills Developed
- **Team Collaboration:** Dividing tasks and merging work via GitHub
- **Problem Solving:** Debugging Laravel errors and UI issues
- **Documentation:** Writing clear project documentation

---

## References

1. Laravel Documentation. (2024). Laravel 13.x Documentation. Retrieved from https://laravel.com/docs/13.x
2. PHP Documentation. (2024). PHP 8.5 Manual. Retrieved from https://www.php.net/docs.php
3. MySQL Documentation. (2024). MySQL Reference Manual. Retrieved from https://dev.mysql.com/doc/
4. MDN Web Docs. (2024). Web Development Resources. Retrieved from https://developer.mozilla.org/
5. Stack Overflow. (2024). Programming Q&A Platform. Retrieved from https://stackoverflow.com/

---

## Conclusion

Gob Sports successfully demonstrates the implementation of a complete sports e-commerce system using the Laravel framework. The project showcases proficiency in web development fundamentals including MVC architecture, database design, user authentication, shopping cart management, and responsive web design.

### Key Achievements
- Successfully implemented all required Laravel components (Routes, Controllers, Views, Models)
- Created a fully functional e-commerce system with product filtering, cart, and checkout
- Developed a clean, responsive user interface with consistent design
- Implemented product review system with purchase verification
- Applied security best practices for user authentication and form validation

---

- **Project Completion Date:** 12 June 2026
- **Course:** BIIT 2305 Web Application Development
- **GitHub Repository:** https://github.com/luthfitaher-a11y/BIIT-2305-Group-Project-Group-Gob
