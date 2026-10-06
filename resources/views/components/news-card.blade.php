<article class="news-card">
    <div class="news-card-body">
        <span class="news-category">{{ $item->category }}</span>
        <h2 class="news-card-title">{{ $item->title }}</h2>
        <p class="news-card-excerpt">{{ \Illuminate\Support\Str::limit($item->content, 140) }}</p>
        <span class="news-author">Автор: {{ $item->user?->username ?? 'Аноним' }}</span>
        <a class="news-card-link" href="{{ route('news.show', $item->id) }}">Читать далее</a>
    </div>
</article>