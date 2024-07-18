<?php

use App\Models\KitchenSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kitchen_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kitchen_id')->unique();
            $table->enum('delivery_type', KitchenSetting::DELIVERY_TYPE)->default(KitchenSetting::DELIVERY_TYPE[0]);
            $table->boolean('pickup')->default(false);
            $table->foreign('kitchen_id')->on('kitchens')->references('id')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchen_settings');
    }
};
