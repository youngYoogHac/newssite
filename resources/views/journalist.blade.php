@extends('layouts.app')

@section('title', 'Журналист — NewsSite')

@section('content')
    <section class="container narrow-container">
        <h1 class="page-title">Создать новость</h1>
        <form class="news-form">
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" id="title" placeholder="Введите заголовок">
            </div>
            <div class="form-group">
                <label for="category">Категория</label>
                <select id="category">
                    <option>Технологии</option>
                    <option>Наука</option>
                </select>
            </div>
            <div class="form-group">
                <label for="content">Текст статьи</label>
                <textarea id="content" rows="8" placeholder="Введите текст"></textarea>
            </div>
            <button type="submit" class="btn">Опубликовать</button>
        </form>
    </section>
@endsection