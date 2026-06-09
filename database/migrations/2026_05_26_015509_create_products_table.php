<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();                                                   // product_id (PK)
            $table->foreignId('category_id')
                  ->constrained()
                  ->onDelete('cascade');                                    // FK → categories
            $table->foreignId('brand_id')
                  ->constrained()
                  ->onDelete('cascade');                                    // FK → brands
            $table->string('name');                                         // product_name
            $table->text('description');                                    // product_description
            $table->decimal('price', 10, 2);                               // product_price
            $table->decimal('old_price', 10, 2)->nullable();               // original price (for sale badge)
            $table->integer('stock')->default(0);                          // product_stock
            $table->string('image')->nullable();                           // product_image (file path)
            $table->string('badge')->nullable();                           // popular | sale | new
            $table->string('sport');                                        // soccer | rugby | badminton
            $table->string('tags')->nullable();                            // comma-separated tags
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
