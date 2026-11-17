@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="card mx-auto" style="max-width: 420px">
    <div class="card-body">
        <h1 class="h4 mb-3">Регистрация</h1>
        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
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
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control">
            </div>
            <button class="btn btn-primary" type="submit">Зарегистрироваться</button>
            <a class="ms-2" href="{{ route('login') }}">Уже есть аккаунт</a>
        </form>
    </div>
</div>
@endsection
