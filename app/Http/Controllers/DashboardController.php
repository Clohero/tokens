<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        // Сумма трат текущего пользователя за текущий месяц по каждой категории (один запрос)
        $sums = Expense::query()
            ->where('user_id', $request->user()->id)
            ->whereBetween('spent_at', [
                now()->startOfMonth()->toDateString(),
                now()->endOfMonth()->toDateString(),
            ])
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->pluck('total', 'category_id');

        $rows = Category::orderBy('name')->get()->map(function (Category $category) use ($sums) {
            $spent = (int) ($sums[$category->id] ?? 0);
            $limit = $category->monthly_limit;

            return [
                'category' => $category,
                'spent' => $spent,
                'limit' => $limit,
                'remaining' => $limit === null ? null : $limit - $spent,
                'percent' => $this->percent($spent, $limit),
                'status' => $this->status($spent, $limit),
            ];
        });

        return view('dashboard', [
            'withLimit' => $rows->where('status', '!=', 'no_limit')->values(),
            'noLimit' => $rows->where('status', 'no_limit')->values(),
            'month' => now()->format('m.Y'),
        ]);
    }

    /** ok: < 80%, warning: 80–100%, danger: > 100%, no_limit: лимита нет. */
    private function status(int $spent, ?int $limit): string
    {
        if ($limit === null) {
            return 'no_limit';
        }

        if ($spent === 0) {
            return 'ok'; // нет трат за месяц
        }

        if ($spent > $limit) {
            return 'danger';
        }

        return $spent * 100 >= $limit * 80 ? 'warning' : 'ok';
    }

    /** Целый процент использования лимита (без округления вверх, чтобы совпадать со статусом). */
    private function percent(int $spent, ?int $limit): ?int
    {
        if ($limit === null) {
            return null;
        }

        if ($limit === 0) {
            return $spent > 0 ? 100 : 0;
        }

        return intdiv($spent * 100, $limit);
    }
}
