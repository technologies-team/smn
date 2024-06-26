<?php

use App\Models\Coupon;
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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type',Coupon::TYPE);
            $table->decimal('percent_limited',10, 2)->nullable();
            $table->decimal('min_amount',10, 2)->nullable();
            $table->decimal('value', 10, 2)->nullable();
            $table->dateTime('start_at');
            $table->dateTime('expires_at');
            $table->boolean('enabled')->default(true);
            $table->integer('count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
