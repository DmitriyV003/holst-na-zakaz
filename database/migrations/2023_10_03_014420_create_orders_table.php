<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('admin_comment')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->string('delivery_address')->nullable();
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('faces');
            $table->unsignedBigInteger('form_application_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('angle_id');
            $table->timestamps();

            $table->foreign('form_application_id')->references('id')->on('form_applications');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->foreign('angle_id')->references('id')->on('angles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
