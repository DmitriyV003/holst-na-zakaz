<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('style_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('style_id');
            $table->unsignedBigInteger('media_id');
            $table->unsignedBigInteger('parent_id');
            $table->timestamps();

            $table->foreign('style_id')->references('id')->on('styles');
            $table->foreign('parent_id')->references('id')->on('style_images');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('style_images');
    }
};
