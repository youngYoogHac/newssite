@extends('layouts.app')

@section('title', 'Главная — NewsSite')

@section('content')
    <section class="container">
        <h1 class="page-title">Последние новости</h1>
        <div class="news-grid">
            {{-- Здесь можно разместить карточки новостей --}}
            <article class="news-card">
                <div class="news-card-body">
                    <span class="news-category">Технологии</span>
                    <h2 class="news-card-title">Пример новости</h2>
                    <p class="news-card-excerpt">Текст новости...</p>
                    <a href="#" class="news-card-link">Читать далее</a>
                </div>
            </article>
        </div>
    </section>
@endsection