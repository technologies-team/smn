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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('name_ar')->nullable();
            $table->text('description_ar')->nullable();
            $table->unsignedBigInteger('photo_id')->nullable();
            $table->enum('type',\App\Models\Offer::TYPE);
            $table->decimal('percent_limited', 10, 2)->nullable();
            $table->decimal('min_amount', 10, 2)->nullable();
            $table->decimal('value', 10, 2)->nullable();
            $table->dateTime('start_at');
            $table->dateTime('expires_at');
            $table->boolean('enabled')->default(true);
            $table->integer('count')->default(0);
            $table->foreign('photo_id')->references('id')->on('attachments')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
