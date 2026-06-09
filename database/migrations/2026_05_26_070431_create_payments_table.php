<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();                                       // payment_id (PK)
            $table->foreignId('order_id')
                  ->constrained()
                  ->onDelete('cascade');                        // FK → orders
            $table->string('payment_method');                  // card | bank | ewallet
            $table->decimal('payment_amount', 10, 2);          // payment_amount
            $table->string('payment_status')->default('pending'); // pending | paid | failed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
