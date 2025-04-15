<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Загружаем данные из файла
        $data = require database_path('seeders/data/regions_data.php');

        // Заполняем таблицы из данных
        DB::table('oblasts')->insert($data['oblasts']);
        DB::table('cities')->insert($data['cities']);
        DB::table('districts')->insert($data['districts']);
        DB::table('mahallas')->insert($data['mahallas']);
    }
}
