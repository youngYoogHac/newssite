@extends('layouts.app')

@section('title', 'Категория — NewsSite')

@section('content')
    <section class="container">
        <h1 class="page-title">Новости категории «Технологии»</h1>
        <div class="news-grid">
            <article class="news-card">
                <div class="news-card-body">
                    <span class="news-category">Технологии</span>
                    <h2 class="news-card-title">Новость в категории</h2>
                    <p class="news-card-excerpt">Описание...</p>
                    <a href="#" class="news-card-link">Читать далее</a>
                </div>
            </article>
        </div>
    </section>
@endsection