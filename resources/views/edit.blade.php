@extends('layouts.app')

@section('title', 'Редактировать — NewsSite')

@section('content')
    <section class="form-section">
        <div class="container narrow-container">
            <div class="form-header">
                <h1 class="page-title">Редактировать статью</h1>
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

            <form class="news-form" action="{{ route('news.update', $text->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="heading">Заголовок</label>
                    <input id="heading" name="heading" type="text"
                           value="{{ old('heading', $text->heading) }}" required maxlength="255">
                </div>

                <div class="form-group">
                    <label for="category_id">Категория</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">Выберите категорию</option>
                        
                        @foreach ($categories as $parent)
                            <optgroup label="{{ $parent->name }}">
                                <option value="{{ $parent->id }}" 
                                        @selected(old('category_id', $text->category_id) == $parent->id)>
                                    {{ $parent->name }} (Общая)
                                </option>
                                @foreach ($parent->children as $child)
                                    <option value="{{ $child->id }}" 
                                            @selected(old('category_id', $text->category_id) == $child->id)>
                                        — {{ $child->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="text">Текст статьи</label>
                    <textarea id="text" name="text" rows="12" required>{{ old('text', $text->text) }}</textarea>
                </div>

                <button class="btn" type="submit">Сохранить изменения</button>
                <a class="btn btn-secondary" href="{{ route('news.show', $text->id) }}">Отмена</a>
            </form>
        </div>
    </section>
@endsection