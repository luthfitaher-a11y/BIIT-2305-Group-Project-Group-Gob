<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();                                           // order_item_id (PK)
            $table->foreignId('order_id')
                  ->constrained()
                  ->onDelete('cascade');                            // FK → orders
            $table->foreignId('product_id')
                  ->constrained()
                  ->onDelete('cascade');                            // FK → products
            $table->integer('quantity');                           // order_item_quantity
            $table->decimal('price', 10, 2);                       // order_item_price (snapshot)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
