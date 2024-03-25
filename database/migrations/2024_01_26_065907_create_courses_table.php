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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('main_category_id')->default('-1')->nullable();
            $table->integer('subcategory_id')->default('-1')->nullable();
            $table->integer('instructor_id')->default('-1')->nullable();
            $table->string('course_image')->default('-1')->nullable();
            $table->string('course_tittle')->default('-1')->nullable();
            $table->string('course_name')->default('-1')->nullable();
            $table->string('course_name_slug')->default('-1')->nullable();

            $table->longText('description')->default('-1')->nullable();
            $table->string('video')->default('-1')->nullable();
            $table->string('level')->default('-1')->nullable();          
            $table->string('duration')->default('-1')->nullable();
            $table->string('resources')->default('-1')->nullable();
            $table->string('certificate')->default('-1')->nullable();

            $table->integer('selling_price')->default('-1')->nullable();
            $table->integer('discount_price')->default('-1')->nullable();
            $table->text('prerequisites')->default('-1')->nullable();
            $table->string('bestseller')->default('-1')->nullable();          
            $table->string('featured')->default('-1')->nullable();
            $table->string('highestrated')->default('-1')->nullable();
            $table->tinyInteger('status')->default(0)->nullable()->comment('0=Inactive','1=Active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
