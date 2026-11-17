<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'category_id' => ['nullable', 'integer'],
            'month' => ['nullable', 'date_format:Y-m'],
        ]);

        $query = $request->user()->expenses()->with('category');

        if (! empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (! empty($filters['month'])) {
            $month = Carbon::createFromFormat('!Y-m', $filters['month']);
            $query->whereBetween('spent_at', [
                $month->copy()->startOfMonth()->toDateString(),
                $month->copy()->endOfMonth()->toDateString(),
            ]);
        }

        return view('expenses.index', [
            'expenses' => $query->latest('spent_at')->latest('id')->paginate(20)->withQueryString(),
            'categories' => Category::orderBy('name')->get(),
            'filters' => $filters,
        ]);
    }

    public function create(): View
    {
        return view('expenses.create', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());

        $request->user()->expenses()->create($data);

        return redirect()->route('dashboard')->with('success', 'Трата добавлена');
    }

    public function show(Expense $expense): View
    {
        Gate::authorize('view', $expense);

        return view('expenses.show', [
            'expense' => $expense->load('category'),
        ]);
    }

    public function edit(Expense $expense): View
    {
        Gate::authorize('update', $expense);

        return view('expenses.edit', [
            'expense' => $expense,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Expense $expense): RedirectResponse
    {
        Gate::authorize('update', $expense);

        $expense->update($request->validate($this->rules()));

        return redirect()->route('expenses.index')->with('success', 'Трата обновлена');
    }

    public function destroy(Expense $expense): RedirectResponse
    {
        Gate::authorize('delete', $expense);

        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Трата удалена');
    }

    /** Правила валидации одинаковы для создания и редактирования. */
    private function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'amount' => ['required', 'integer', 'min:1', 'max:100000000'],
            'description' => ['nullable', 'string', 'max:255'],
            'spent_at' => [
                'required',
                'date',
                'before_or_equal:today',
                'after_or_equal:' . now()->startOfYear()->toDateString(),
            ],
        ];
    }
}
