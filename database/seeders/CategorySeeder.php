<?php

namespace Database\Seeders;
use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['slug' => 'domashnee-zadanie', 'name' => 'Домашнее задание', 'monthly_limit' => 30000, 'color' => '#22c55e'],
            ['slug' => 'rabota',            'name' => 'Работа',           'monthly_limit' => 20000, 'color' => '#3b82f6'],
            ['slug' => 'tvorchestvo',       'name' => 'Творчество',       'monthly_limit' => 10000, 'color' => '#a855f7'],
            ['slug' => 'poisk-i-parsing',   'name' => 'Поиск и парсинг',  'monthly_limit' => 5000,  'color' => '#f97316'],
            ['slug' => 'chat',              'name' => 'Чат',              'monthly_limit' => 3000,  'color' => '#ec4899'],
            ['slug' => 'lichnye-interesy',  'name' => 'Личные интересы',  'monthly_limit' => null,  'color' => '#6b7280'],
        ];

        foreach ($categories as $data) {
            // идемпотентно: повторный запуск не создаёт дублей
            Category::firstOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
