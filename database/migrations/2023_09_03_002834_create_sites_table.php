<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('main_image');
            $table->string('main_title');
            $table->string('address');
            $table->string('email');
            $table->string('skype')->nullable();
            $table->string('phone_country');
            $table->string('phone_moscow');
            $table->string('phone_spb');
            $table->string('support');
            $table->string('work_hours');
            $table->string('tin');
            $table->string('ip');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sites');
    }
};
