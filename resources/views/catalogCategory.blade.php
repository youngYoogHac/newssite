@extends('layouts.app')

@section('title', 'Категория: ' . $category)

@section('content')
    <section class="container">
        <a class="back-link" href="{{ route('catalog') }}">← Все категории</a>
        <h1 class="page-title">Новости категории «{{ $category }}»</h1>

        @if ($texts->isEmpty())
            <p>В этой категории пока нет новостей.</p>
        @else
            <div class="news-grid">
                @foreach ($texts as $text)
                    <x-news-card :item="$text" />
                @endforeach
            </div>
        @endif
    </section>
@endsection