@extends('layouts.app')

@section('title', 'Вход — NewsSite')

@section('content')
    <section class="form-section">
        <div class="container narrow-container">
            <div class="form-header">
                <h1 class="page-title">Войти</h1>
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

            <form class="news-form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Логин</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input id="password" name="password" type="password" required>
                </div>
                <button class="btn" type="submit">Войти</button>
            </form>

            <p class="form-note">Нет аккаунта? <a class="text-link" href="{{ route('register') }}">Зарегистрироваться</a></p>
        </div>
    </section>
@endsection