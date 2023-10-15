<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('field_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('site_field_type', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->string('location');
            $table->unsignedBigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->unsignedBigInteger('field_type_id');
            $table->foreign('field_type_id')->references('id')->on('field_types');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_field_type');
        Schema::dropIfExists('field_types');
    }
};
