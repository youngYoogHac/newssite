@extends('layouts.app')

@section('title', 'Каталог — NewsSite')

@section('content')
    <section class="container">
        <h1 class="page-title">Каталог категорий</h1>

        <div class="category-grid">
            <a class="category-card" href="{{ route('catalog.category', 'Технологии') }}">
                <span class="category-icon">💻</span>
                <span class="category-name">Технологии</span>
                <span class="category-description">Новые устройства, интернет и цифровые продукты.</span>
            </a>

            <a class="category-card" href="{{ route('catalog.category', 'Программирование') }}">
                <span class="category-icon">👨‍💻</span>
                <span class="category-name">Программирование</span>
                <span class="category-description">Разработка ПО, языки, фреймворки и инструменты.</span>
            </a>

            <a class="category-card" href="{{ route('catalog.category', 'Наука') }}">
                <span class="category-icon">🔬</span>
                <span class="category-name">Наука</span>
                <span class="category-description">Исследования, открытия и научные достижения.</span>
            </a>

            <a class="category-card" href="{{ route('catalog.category', 'Спорт') }}">
                <span class="category-icon">🏆</span>
                <span class="category-name">Спорт</span>
                <span class="category-description">События, соревнования, команды и спортсмены.</span>
            </a>

            <a class="category-card" href="{{ route('catalog.category', 'Мир') }}">
                <span class="category-icon">🌍</span>
                <span class="category-name">Мир</span>
                <span class="category-description">Международные события и новости со всего мира.</span>
            </a>

            <a class="category-card" href="{{ route('catalog.category', 'Экономика') }}">
                <span class="category-icon">📈</span>
                <span class="category-name">Экономика</span>
                <span class="category-description">Рынки, бизнес, финансы и экономические тренды.</span>
            </a>
        </div>
    </section>
@endsection