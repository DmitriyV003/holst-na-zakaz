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
            $table->unsignedBigInteger('slide_number');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('style_images');
    }
};
