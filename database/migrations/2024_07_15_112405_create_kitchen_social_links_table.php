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
        Schema::create('kitchen_social_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kitchen_id');

            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('phone')->nullable();
            $table->string('snap')->nullable();
            $table->string('x')->nullable();
            $table->string('website')->nullable();
            $table->foreign('kitchen_id')->on('kitchens')->references('id')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchen_social_links');
    }
};
