@extends('layouts.app')

@section('title', 'Дашборд')

@php
    $colors = ['ok' => 'success', 'warning' => 'warning', 'danger' => 'danger'];
    $labels = ['ok' => 'В норме', 'warning' => 'Близко к лимиту', 'danger' => 'Перерасход'];
@endphp

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="h3 mb-0">Дашборд</h1>
        <div class="text-muted">Расход токенов за {{ $month }}</div>
    </div>
    <a class="btn btn-primary" href="{{ route('expenses.create') }}">+ Добавить трату</a>
</div>

<div class="card mb-4">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Категория</th>
                    <th class="text-end">Потрачено</th>
                    <th class="text-end">Лимит</th>
                    <th class="text-end">Остаток</th>
                    <th style="width: 220px">Использовано</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($withLimit as $row)
                @php($color = $colors[$row['status']])
                <tr>
                    <td>
                        <span class="d-inline-block rounded-circle me-2"
                            style="width: 10px; height: 10px; background: {{ $row['category']->color }}"></span>
                        {{ $row['category']->name }}
                    </td>
                    <td class="text-end">{{ number_format($row['spent'], 0, ',', ' ') }}</td>
                    <td class="text-end">{{ number_format($row['limit'], 0, ',', ' ') }}</td>
                    <td class="text-end {{ $row['remaining'] < 0 ? 'text-danger fw-semibold' : '' }}">
                        {{ number_format($row['remaining'], 0, ',', ' ') }}
                    </td>
                    <td>
                        <div class="progress" style="height: 8px">
                            <div class="progress-bar bg-{{ $color }}" style="width: {{ min($row['percent'], 100) }}%"></div>
                        </div>
                        <small class="text-muted">{{ $row['percent'] }}%</small>
                    </td>
                    <td><span class="badge text-bg-{{ $color }}">{{ $labels[$row['status']] }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<h2 class="h5">Без лимита</h2>
<div class="card">
    <ul class="list-group list-group-flush">
        @forelse ($noLimit as $row)
            <li class="list-group-item d-flex justify-content-between">
                <span>
                    <span class="d-inline-block rounded-circle me-2"
                        style="width: 10px; height: 10px; background: {{ $row['category']->color }}"></span>
                    {{ $row['category']->name }}
                </span>
                <span>{{ number_format($row['spent'], 0, ',', ' ') }} токенов за месяц</span>
            </li>
        @empty
            <li class="list-group-item text-muted">Все категории с лимитом</li>
        @endforelse
    </ul>
</div>
@endsection
