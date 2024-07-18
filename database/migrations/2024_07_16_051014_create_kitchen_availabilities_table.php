<?php

use App\Models\KitchenAvailability;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kitchen_availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kitchen_id')->constrained()->onDelete('cascade');
            $table->enum('day', KitchenAvailability::DAYS);
            $table->unique(['kitchen_id', 'day']);
            $table->time('start_time')->nullable();
            $table->boolean('is_available')->default(true);
            $table->time('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchen_availabilities');
    }
};
