<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Домашнее задание',
            'Работа',
            'Творчество',
            'Поиск и парсинг',
            'Чат',
            'Личные интересы',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name, '-', 'ru'), // транслитерация: «Чат» → chat
            'monthly_limit' => fake()->randomElement([null, 3000, 5000, 10000, 20000, 30000]),
            'color' => fake()->hexColor(),
        ];
    }
}
