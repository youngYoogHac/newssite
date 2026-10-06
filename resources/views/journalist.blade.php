@extends('layouts.app')

@section('title', 'Журналист — NewsSite')

@section('content')
    <section class="form-section">
        <div class="container narrow-container">
            <div class="form-header">
                <h1 class="page-title">Создать новость</h1>
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

            <form class="news-form" action="{{ route('news.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input id="title" name="title" type="text" value="{{ old('title') }}" required maxlength="255">
                </div>

                <div class="form-group">
                    <label for="category">Категория</label>
                    <select id="category" name="category" required>
                        @foreach (['Технологии', 'Программирование', 'Наука', 'Спорт', 'Мир', 'Экономика'] as $cat)
                            <option value="{{ $cat }}" @selected(old('category') === $cat)>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="content">Текст статьи</label>
                    <textarea id="content" name="content" rows="12" required>{{ old('content') }}</textarea>
                </div>

                <button class="btn" type="submit">Опубликовать</button>
            </form>
        </div>
    </section>
@endsection