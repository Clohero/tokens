@extends('layouts.app')

@section('title', 'Новая трата')

@section('content')
<h1 class="h3 mb-3">Новая трата токенов</h1>
<form method="POST" action="{{ route('expenses.store') }}" class="card card-body" style="max-width: 560px" novalidate>
    @include('expenses._form')
</form>
@endsection
