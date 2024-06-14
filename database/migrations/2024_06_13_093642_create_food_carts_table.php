<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('food_carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->integer('sub_tax')->nullable(0);
            $table->decimal('sub_price');
            $table->decimal('sub_rewards')->nullable();
            $table->decimal('price');
            $table->decimal('rewards')->nullable();
            $table->integer('tax')->default(0);
            $table->integer('quantity');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('restrict');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('restrict');
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_carts');
    }
};
