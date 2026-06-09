<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();                                           // cart_item_id (PK)
            $table->foreignId('cart_id')
                  ->constrained()
                  ->onDelete('cascade');                            // FK → carts
            $table->foreignId('product_id')
                  ->constrained()
                  ->onDelete('cascade');                            // FK → products
            $table->integer('quantity')->default(1);               // cart_item_quantity
            $table->decimal('price', 10, 2);                       // cart_item_price (snapshot)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
