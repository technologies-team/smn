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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->float('price');
            $table->float('total_price');
            $table->float('discount')->nullable();
            $table->json("options")->nullable();
            $table->float('total_discount')->nullable();
            $table->integer('quantity');
            $table->foreign("cart_id")->references("id")->on("carts")->onDelete("cascade");
            $table->foreign("food_id")->references("id")->on("foods")->onDelete("cascade");
            $table->foreign("offer_id")->references("id")->on("offers")->onDelete("cascade");
            $table->foreign("coupon_id")->references("id")->on("coupons")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
