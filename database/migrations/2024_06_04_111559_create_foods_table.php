<?php

use App\Models\Food;
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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_ar')->nullable();
            $table->text('description')->nullable();
            $table->text('description_ar')->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->boolean('deliverable')->default(false);
            $table->string('unit')->nullable();
            $table->enum('status',Food::STATUS)->default("hidden");
            $table->time('preparation_time')->nullable();
            $table->json("ingredients")->nullable();
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('kitchen_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->unsignedBigInteger('photo_id')->nullable();
            $table->integer('rewards')->nullable();
            $table->foreign('kitchen_id')->references('id')->on('kitchens')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('tag_id')  ->references('id')->on('tags')->onDelete('set null');
            $table->foreign('photo_id')->references('id')->on('attachments')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
