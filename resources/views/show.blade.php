@extends('layouts.app')

@section('title', 'Новость — NewsSite')

@section('content')
    <section class="container narrow-container">
        <a class="back-link" href="/">← Все новости</a>

        @if ($news)
            <article class="article">
                <div class="article-meta">
                    <span class="news-category">{{ $news->category }}</span>
                    <time datetime="{{ $news->created_at->toISOString() }}">
                        {{ $news->created_at->format('d.m.Y H:i') }}
                    </time>
                </div>
                <h1 class="article-title">{{ $news->title }}</h1>
                <div class="article-content">{!! nl2br(e($news->content)) !!}</div>
            </article>

            <a class="btn btn-secondary" href="{{ route('main') }}">Вернуться к новостям</a>
        @else
            <div class="alert alert-error">
                <h1>Новость не найдена</h1>
                <p>Материал с указанным ID отсутствует.</p>
            </div>
            <a class="btn" href="{{ route('main') }}">На главную</a>
        @endif
    </section>
@endsection