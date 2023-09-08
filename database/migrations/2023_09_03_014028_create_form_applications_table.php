<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('form_applications', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('form_type_id');
            $table->timestamps();

            $table->foreign('form_type_id')->references('id')->on('form_types');
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_applications');
    }
};
