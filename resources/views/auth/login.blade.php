@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<div class="card mx-auto" style="max-width: 420px">
    <div class="card-body">
        <h1 class="h4 mb-3">Вход</h1>
        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Запомнить меня</label>
            </div>
            <button class="btn btn-primary" type="submit">Войти</button>
            <a class="ms-2" href="{{ route('register') }}">Регистрация</a>
        </form>
    </div>
</div>
@endsection
