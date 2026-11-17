@extends('layouts.app')

@section('title', 'Редактирование траты')

@section('content')
<h1 class="h3 mb-3">Редактирование траты</h1>
<form method="POST" action="{{ route('expenses.update', $expense) }}" class="card card-body" style="max-width: 560px" novalidate>
    @method('PUT')
    @include('expenses._form')
</form>
@endsection
