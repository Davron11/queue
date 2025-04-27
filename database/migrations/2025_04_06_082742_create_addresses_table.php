<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();  // ID для таблицы
            $table->unsignedBigInteger('oblast_id');  // Ссылка на ID области
            $table->unsignedBigInteger('city_id');    // Ссылка на ID города
            $table->unsignedBigInteger('district_id'); // Ссылка на ID района
            $table->unsignedBigInteger('mahalla_id');  // Ссылка на ID махалли
            $table->string('home');  // Адрес (дом 4/46 и т.д.)
            $table->timestamps();

            // Добавляем внешние ключи для связей
            $table->foreign('oblast_id')->references('id')->on('oblasts')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('mahalla_id')->references('id')->on('mahallas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
