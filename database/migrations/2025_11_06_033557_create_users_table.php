<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Ini adalah bigIncrements, unsigned, dan primary key
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role', 50)->default('user');
            $table->timestamps(); // Ini membuat created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
