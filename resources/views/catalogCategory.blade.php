@extends('layouts.app')

@section('title', 'Категория: ' . $category)

@section('content')
    <section class="container">
        <a class="back-link" href="/catalog">← Все категории</a>
        <h1 class="page-title">Новости категории «{{ $category }}»</h1>

        @if ($news->isEmpty())
            <p>В этой категории пока нет новостей.</p>
        @else
            <div class="news-grid">
                @foreach ($news as $item)
                    <x-news-card :item="$item" />
                @endforeach
            </div>
        @endif
    </section>
@endsection