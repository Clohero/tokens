<?php

namespace Database\Factories;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'amount' => fake()->numberBetween(50, 5000),
            'description' => fake()->randomElement([
                'Разбор темы к экзамену',
                'Черновик письма',
                'Идеи для проекта',
                'Сводка статей по теме',
                'Проверка кода',
                'Перевод абзаца',
                'План на неделю',
                'Варианты названий',
                'Разбор ошибки в программе',
                'Конспект лекции',
                'Подбор литературы',
                'Сравнение двух подходов',
            ]),
            'spent_at' => fake()->dateTimeBetween(now()->startOfMonth(), 'now'),
        ];
    }
}
