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
                    <label for="heading">Заголовок</label>
                    <input id="heading" name="heading" type="text"
                           value="{{ old('heading') }}" required maxlength="255">
                </div>

                <div class="form-group">
                    <label for="category_id">Категория</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">Выберите категорию</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                    @selected(old('category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="text">Текст статьи</label>
                    <textarea id="text" name="text" rows="12" required>{{ old('text') }}</textarea>
                </div>

                <button class="btn" type="submit">Опубликовать</button>
            </form>
        </div>
    </section>
@endsection