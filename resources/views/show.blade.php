@extends('layouts.app')

@section('title', $text ? $text->heading . ' — NewsSite' : 'Новость — NewsSite')

@section('content')
    <section class="container narrow-container">
        <a class="back-link" href="{{ route('main') }}">← Все новости</a>

        @if ($text)
            <article class="article">
                <div class="article-meta">
                    <span class="news-category">{{ $text->category->fullName() }}</span>
                    <span>Автор: {{ $text->user?->login ?? 'Аноним' }}</span>
                    <time datetime="{{ $text->created_at->toISOString() }}">
                        {{ $text->created_at->format('d.m.Y H:i') }}
                    </time>
                    @if ($text->is_blocked)
                        <span class="badge-blocked">Заблокировано</span>
                    @endif
                </div>
                <h1 class="article-title">{{ $text->heading }}</h1>
                <div class="article-content">{!! nl2br(e($text->text)) !!}</div>
            </article>

            <div class="article-actions" style="display: flex; gap: 12px; margin-bottom: 20px;">
                @auth
                    @if (auth()->id() === $text->user_id || auth()->user()->role?->name === 'admin')
                        <a class="btn" href="{{ route('news.edit', $text->id) }}">Редактировать</a>
                    @endif
                @endauth

                <a class="btn btn-secondary" href="{{ route('main') }}">Вернуться к новостям</a>
            </div>
        @else
            <div class="alert alert-error">
                <h1>Новость не найдена</h1>
                <p>Материал с указанным ID отсутствует или скрыт администратором.</p>
            </div>
            <a class="btn" href="{{ route('main') }}">На главную</a>
        @endif
    </section>
@endsection