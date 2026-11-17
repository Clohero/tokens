<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    private const TOTAL = 150;

    public function run(): void
    {
        // Идемпотентность: если траты уже есть, ничего не добавляем
        if (Expense::exists()) {
            $this->command?->info('Траты уже есть, пропускаю.');
            return;
        }

        $users = User::all();
        $categories = Category::all()->keyBy('slug');

        $monthStart = now()->startOfMonth();
        $windowStart = now()->subMonthsNoOverflow(2)->startOfMonth(); // последние три месяца
        $prevMonthEnd = now()->subMonthNoOverflow()->endOfMonth();

        $chat = $categories['chat'];
        $homework = $categories['domashnee-zadanie'];

        // Демонстрационные траты в текущем месяце для каждого пользователя
        foreach ($users as $user) {
            // «Чат»: перерасход, 115% лимита
            foreach ($this->split((int) round($chat->monthly_limit * 1.15), 3) as $amount) {
                Expense::factory()->create([
                    'user_id' => $user->id,
                    'category_id' => $chat->id,
                    'amount' => $amount,
                    'spent_at' => fake()->dateTimeBetween($monthStart, 'now'),
                ]);
            }

            // «Домашнее задание»: приближение к лимиту, ровно 85%
            foreach ($this->split((int) round($homework->monthly_limit * 0.85), 5) as $amount) {
                Expense::factory()->create([
                    'user_id' => $user->id,
                    'category_id' => $homework->id,
                    'amount' => $amount,
                    'spent_at' => fake()->dateTimeBetween($monthStart, 'now'),
                ]);
            }
        }

        // Остальные траты случайно распределяем до 150 штук
        $demoSlugs = ['chat', 'domashnee-zadanie'];
        $remaining = self::TOTAL - Expense::count();

        for ($i = 0; $i < $remaining; $i++) {
            $category = $categories->random();

            // У демо-категорий текущий месяц не трогаем, чтобы 115% и 85% остались точными
            $to = in_array($category->slug, $demoSlugs, true) ? $prevMonthEnd : now();

            Expense::factory()->create([
                'user_id' => $users->random()->id,
                'category_id' => $category->id,
                'spent_at' => fake()->dateTimeBetween($windowStart, $to),
            ]);
        }
    }

    /** Делит сумму на части, остаток уходит в последнюю. */
    private function split(int $total, int $parts): array
    {
        $base = intdiv($total, $parts);
        $chunks = array_fill(0, $parts, $base);
        $chunks[$parts - 1] += $total - $base * $parts;

        return $chunks;
    }
}
