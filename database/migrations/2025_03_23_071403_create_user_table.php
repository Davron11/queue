<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name'); // ФИО (обязательное)
            $table->string('phone_number'); // Номер телефона (обязательное)
            $table->string('address'); // Адрес (обязательное)
            $table->string('passport_data'); // Паспортные данные (обязательное)
            $table->string('pinfl', 14)->unique(); // ПИНФЛ (обязательное, уникальное)
            $table->string('email')->nullable(); // Email (необязательное)
            $table->string('photo_path')->nullable(); // Фото (необязательное)
            $table->string('password'); // Пароль
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
