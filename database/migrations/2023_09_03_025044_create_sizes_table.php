<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('size');
            $table->boolean('is_show');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('site_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('site_id')->references('id')->on('sites');
            $table->unique(['size', 'site_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sizes');
    }
};
