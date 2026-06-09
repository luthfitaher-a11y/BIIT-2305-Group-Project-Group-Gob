<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();                               // user_id (PK)
            $table->string('name');                     // user_name
            $table->string('email')->unique();          // user_email
            $table->string('password');                 // user_password
            $table->string('phone')->nullable();        // user_phone
            $table->text('address')->nullable();        // user_address
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};