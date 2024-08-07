<?php

use App\Models\Option;
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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->enum("type",Option::TYPE);
            $table->float("price")->default(0);
            $table->boolean("mandatory")->default(0);
            $table->unsignedBigInteger("parent_id")->nullable();
            $table->unsignedBigInteger("food_id")->nullable();
            $table->foreign("parent_id")->references("id")->on("options")->onDelete("cascade");
            $table->foreign("food_id")->references("id")->on("foods")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
