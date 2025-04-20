<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pilgrims', function (Blueprint $table) {
            // Удаляем старое поле address
            $table->dropColumn('address');

            // Добавляем новое поле, которое будет ссылаться на pilgrim_details
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('pilgrims', function (Blueprint $table) {
            // Восстанавливаем поле address, если миграция откатывается
            $table->string('address')->nullable();
            $table->dropForeign(['address_id']);
            $table->dropColumn('address_id');
        });
    }
};
