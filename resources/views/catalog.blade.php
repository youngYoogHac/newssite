@extends('layouts.app')

@section('title', 'Каталог — NewsSite')

@section('content')
    <section class="container">
        <h1 class="page-title">Каталог категорий</h1>

        @if ($categories->isEmpty())
            <p>Категорий пока нет.</p>
        @else
            <div class="category-grid">
                @foreach ($categories as $category)
                    @php
                        $icons = [
                            'Технологии'       => '💻',
                            'Программирование' => '👨‍💻',
                            'Наука'            => '🔬',
                            'Спорт'            => '🏆',
                            'Мир'              => '🌍',
                            'Экономика'        => '📈',
                        ];
                    @endphp
                    <a class="category-card" href="{{ route('catalog.category', $category->name) }}">
                        <span class="category-icon">{{ $icons[$category->name] ?? '📰' }}</span>
                        <span class="category-name">{{ $category->name }}</span>
                        <span class="category-description">Статьи категории «{{ $category->name }}».</span>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
@endsection