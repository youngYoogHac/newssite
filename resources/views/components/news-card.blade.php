<article class="news-card">
    <div class="news-card-body">
        <span class="news-category">{{ $item->category->fullName() }}</span>
        <h2 class="news-card-title">{{ $item->heading }}</h2>
        <p class="news-card-excerpt">{{ \Illuminate\Support\Str::limit($item->text, 140) }}</p>
        <span class="news-author">Автор: {{ $item->user?->login ?? 'Аноним' }}</span>
        <a class="news-card-link" href="{{ route('news.show', $item->id) }}">Читать далее</a>
    </div>
</article>