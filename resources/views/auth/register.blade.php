@extends('layouts.app')

@section('title', 'Регистрация — NewsSite')

@section('content')
    <section class="form-section">
        <div class="container narrow-container">
            <div class="form-header">
                <h1 class="page-title">Регистрация</h1>
            </div>

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="news-form" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Логин</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input id="password" name="password" type="password" required minlength="6">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Повторите пароль</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required minlength="6">
                </div>
                <button class="btn" type="submit">Зарегистрироваться</button>
            </form>

            <p class="form-note">Уже есть аккаунт? <a class="text-link" href="{{ route('login') }}">Войти</a></p>
        </div>
    </section>
@endsection