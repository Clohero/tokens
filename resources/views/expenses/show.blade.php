@extends('layouts.app')

@section('title', 'Трата')

@section('content')
<h1 class="h3 mb-3">Трата #{{ $expense->id }}</h1>

<div class="card card-body mb-3" style="max-width: 560px">
    <dl class="row mb-0">
        <dt class="col-sm-5">Количество токенов</dt>
        <dd class="col-sm-7">{{ number_format($expense->amount, 0, ',', ' ') }}</dd>

        <dt class="col-sm-5">Категория</dt>
        <dd class="col-sm-7">{{ $expense->category->name }}</dd>

        <dt class="col-sm-5">Описание</dt>
        <dd class="col-sm-7">{{ $expense->description ?? '—' }}</dd>

        <dt class="col-sm-5">Дата траты</dt>
        <dd class="col-sm-7">{{ $expense->spent_at->format('d.m.Y') }}</dd>

        <dt class="col-sm-5">Запись создана</dt>
        <dd class="col-sm-7">{{ $expense->created_at->format('d.m.Y H:i') }}</dd>
    </dl>
</div>

<div class="d-flex gap-2">
    <a class="btn btn-outline-primary" href="{{ route('expenses.edit', $expense) }}">Редактировать</a>
    <form method="POST" action="{{ route('expenses.destroy', $expense) }}" onsubmit="return confirm('Удалить трату?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-outline-danger" type="submit">Удалить</button>
    </form>
    <a class="btn btn-link" href="{{ route('expenses.index') }}">Назад к списку</a>
</div>
@endsection
