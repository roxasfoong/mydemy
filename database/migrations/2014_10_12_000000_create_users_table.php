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

            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('username')->default('user')->nullable;
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->string('photo')->default('photo')->nullable;
                $table->string('phone')->default('phone')->nullable;
                $table->string('address')->default('address')->nullable;
                $table->enum('role',['admin','instructor','user'])->default('user')->nullable;
                $table->enum('status',['1','0'])->default('1')->nullable;
                $table->rememberToken();
                $table->timestamps();
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
