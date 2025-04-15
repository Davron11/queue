<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahallasTable extends Migration
{
    public function up()
    {
        Schema::create('mahallas', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название махалли
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade'); // Внешний ключ на район
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahallas');
    }
}
