<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();                                           // review_id (PK)
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');                            // FK → users
            $table->foreignId('product_id')
                  ->constrained()
                  ->onDelete('cascade');                            // FK → products
            $table->tinyInteger('rating');                         // review_rating (1–5)
            $table->text('comment');                               // review_comment
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
