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
        Schema::create('course_lectures', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->default('-1')->nullable();
            $table->unsignedBigInteger('section_id')->default('0')->nullable();
            $table->string('lecture_tittle')->default('-1')->nullable();
            $table->string('video')->default('-1')->nullable();
            $table->string('url')->default('-1')->nullable();
            $table->text('content')->default('-1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_lectures');
    }
};
