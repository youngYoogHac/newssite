@extends('layouts.app')

@section('title', 'Каталог — NewsSite')

@section('content')
    <section class="container">
        <h1 class="page-title">Каталог категорий</h1>

        @if ($categories->isEmpty())
            <p>Категорий пока нет.</p>
        @else
            <div class="category-grid">
                {{-- Перебираем ТОЛЬКО родительские категории --}}
                @foreach ($categories->whereNull('parent_id') as $parent)
                    <article class="category-card">
                        {{-- Заголовок родительской категории (ссылка на её статьи) --}}
                        <a href="{{ route('catalog.category', $parent->name) }}" class="category-parent-link">
                            <span class="category-name">{{ $parent->name }}</span>
                        </a>

                        {{-- Список подкатегорий --}}
                        @if ($parent->children->isNotEmpty())
                            <ul class="subcategory-list">
                                @foreach ($parent->children as $child)
                                    <li>
                                        <a href="{{ route('catalog.category', $child->name) }}">
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection