@can('create', \App\Comment::class)
    @include('comments.form')
@else
    <div class="comments__not-registered-message">Хотите добавить комментарий? Пожалуйста, <a href="#" class="comments__link login-link">войдите</a> или <a href="#" class="comments__link register-link">зарегистрируйтесь</a></div>
@endcan

    <div class="comments__items">
        @if(count($comments = $entry->getCommentsSorted()))
        @foreach($comments as $n => $comment)
            @include('comments.comment')
        @endforeach
        @endif
    </div>