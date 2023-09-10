<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('angles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->unsignedInteger('media_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('media_id')->references('id')->on('media');
        });
    }

    public function down()
    {
        Schema::dropIfExists('angles');
    }
};
