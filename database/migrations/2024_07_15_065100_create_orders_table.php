<?php

use App\Models\Order;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('Kitchen_id');
            $table->enum('status', Order::STATUS)->default(Order::STATUS[0]);
            $table->double('price')->nullable();
            $table->double('total_price')->nullable();
            $table->double('rewards')->nullable();
            $table->double('total_rewards')->nullable();
            $table->double('discount')->default(0);

            $table->double('total_discount')->default(0);
            $table->double('total_fee')->default(0);
            $table->double('shipping')->default(0);
            $table->double('total_shipping')->default(0);
            $table->string('notes')->default('');
            $table->string('payment_method');
            $table->dateTime('order_time');

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('Kitchen_id')->references('id')->on('kitchens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
