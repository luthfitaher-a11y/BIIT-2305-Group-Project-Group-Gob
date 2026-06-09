<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();                                               // order_id (PK)
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');                                // FK → users
            $table->decimal('total_amount', 10, 2);                   // total_amount
            $table->decimal('shipping_cost', 10, 2)->default(15);     // shipping cost (0 if free)
            $table->string('status')->default('pending');             // pending | shipped | delivered
            $table->text('shipping_address');                          // full shipping address string
            $table->string('payment_method');                          // card | bank | ewallet
            $table->timestamps();                                      // order_date = created_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
