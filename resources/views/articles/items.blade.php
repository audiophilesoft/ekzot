@spaceless
@foreach($entries ?? [] as $entry)

    <section class="post-preview_{{ $modifier }}{{ ($covered = (bool)$entry->cover) ? '_imaged' : '' }}">
        <header class="post-preview_{{ $modifier }}__header{{ $covered ? '_imaged' : '' }}">
            <a href="{{ $url = route('articles.show', [$entry->catalogue, $entry], false) }}" class="post-preview_{{ $modifier }}__title" {!! ($has_descr = $entry->description) ? 'title="'.$entry->description.'"' : '' !!}>
                <h2>{{ $entry->title }}</h2></a>
        </header>
        @if($covered)
            <a href="{{ $url }}"><img src="{{ '/images'. $url .'/'.$entry->cover }}" alt="{{ $entry->title }}" class="post-preview_{{ $modifier }}__image" {!! $has_descr ? 'title="'.$entry->description.'"' : ''  !!}></a>
        @else
            <div class="post-preview_{{ $modifier }}__content">

                <div class="post-preview_{{ $modifier }}__content__wrapper">

                    {!! mb_substr($entry->content, 0, 2048) !!}
                </div>
                    <div class="post-preview_{{ $modifier }}__content__full-link">
                        <a href="{{ $url }}">хочу дочитать</a>
                    </div>
            </div>
        @endif
        <footer class="post-preview_{{ $modifier }}__footer">
            <div class="post-preview_{{ $modifier }}__footer__wrapper">
                <div class="post-preview_{{ $modifier }}__date">
                    <span class="post-preview_{{ $modifier }}__date__value">{{ $entry->created_at->format('d.m.Y') }}</span>
                </div>
                <div class="post-preview_{{ $modifier }}__views-num">
                    <span class="post-preview_{{ $modifier }}__views-num__value">{{ $entry->views_count }}</span>
                </div>
                @if($comments_count = count($entry->comments))
                    <a class="post-preview_{{ $modifier }}__comments-num" href="{{ $url }}#comments">
                        <span class="post-preview_{{ $modifier }}__comments-num__value">{{ $comments_count }}</span>
                    </a>
                @else
                    <div class="post-preview_{{ $modifier }}__comments-num">
                        <span class="post-preview_{{ $modifier }}__comments-num__value">0</span>
                    </div>
                @endif
            </div>
        </footer>
    </section>
@endforeach
@endspaceless