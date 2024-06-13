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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kitchen_id');
            $table->unsignedBigInteger('total_tax')->nullable();
            $table->unsignedBigInteger('total_price');
            $table->unsignedBigInteger('total_rewards')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('set null');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('set null');
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("kitchen_id")->references("id")->on("kitchens")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
