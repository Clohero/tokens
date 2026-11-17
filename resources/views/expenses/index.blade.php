@extends('layouts.app')

@section('title', 'Мои траты')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Мои траты токенов</h1>
    <a class="btn btn-primary" href="{{ route('expenses.create') }}">+ Добавить трату</a>
</div>

<form method="GET" action="{{ route('expenses.index') }}" class="row g-2 mb-3">
    <div class="col-md-4">
        <select name="category_id" class="form-select">
            <option value="">Все категории</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(($filters['category_id'] ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <input type="month" name="month" value="{{ $filters['month'] ?? '' }}" class="form-control">
    </div>
    <div class="col-auto">
        <button class="btn btn-outline-primary" type="submit">Фильтровать</button>
        <a class="btn btn-link" href="{{ route('expenses.index') }}">Сбросить</a>
    </div>
</form>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Категория</th>
                    <th>Описание</th>
                    <th class="text-end">Токены</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @forelse ($expenses as $expense)
                <tr>
                    <td>{{ $expense->spent_at->format('d.m.Y') }}</td>
                    <td><span class="badge" style="background: {{ $expense->category->color }}">{{ $expense->category->name }}</span></td>
                    <td>{{ $expense->description ?? '—' }}</td>
                    <td class="text-end">{{ number_format($expense->amount, 0, ',', ' ') }}</td>
                    <td class="text-end text-nowrap">
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('expenses.show', $expense) }}">Просмотр</a>
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('expenses.edit', $expense) }}">Редактировать</a>
                        <form method="POST" action="{{ route('expenses.destroy', $expense) }}" class="d-inline"
                                onsubmit="return confirm('Удалить трату?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Трат пока нет</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $expenses->links() }}</div>
@endsection
