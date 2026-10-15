@extends('layouts.app')

@section('title', 'Главная — NewsSite')

@section('content')
    <section class="container">
        <h1 class="page-title">Последние новости</h1>

        @if ($texts->isEmpty())
            <p>Новостей пока нет</p>
        @else
            <div class="news-grid">
                @foreach ($texts as $text)
                    <x-news-card :item="$text" />
                @endforeach
            </div>
        @endif
    </section>
@endsection