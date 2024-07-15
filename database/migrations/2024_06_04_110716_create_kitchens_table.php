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
        Schema::create('kitchens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title');
            $table->string('title_ar')->nullable();
            $table->text('description')->nullable();
            $table->text('description_ar')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->boolean('verified')->default(false);
            $table->boolean('ready_to_delivery')->default(false);
            $table->integer('delivery_fee')->nullable();
            $table->enum('status',["open","busy","closed"])->default("closed");
            $table->boolean('active')->default(false);
            $table->unsignedBigInteger('photo_id')->nullable();
            $table->unsignedBigInteger('front_id')->nullable();
            $table->unsignedBigInteger('back_id')->nullable();
            $table->unsignedBigInteger('cover_id')->nullable();
            $table->foreign('photo_id')->references('id')->on('attachments')->onDelete('set null');
            $table->foreign('front_id')->references('id')->on('attachments')->onDelete('set null');
            $table->foreign('back_id')->references('id')->on('attachments')->onDelete('set null');
            $table->foreign('cover_id')->references('id')->on('attachments')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchens');
    }
};
