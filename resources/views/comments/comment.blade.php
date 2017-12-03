@spaceless
<div class="comments__thread-container" data-id="{{ $comment->id }}">
    <div class="comment" id="{{ $id = "comment-{$comment->id}" }}">
        <header class="comment__header">
            <a class="comment__number" href="#{{ $id }}" title="Ссылка на этот комментарий">{{ $comment->number }}</a>
            <div class="comment__avatar">
                <div class="comment__avatar__outer-wrapper">
                    <div class="comment__avatar__inner-wrapper">
                        @if($a = $comment->user->avatar)
                            <img src="{{ config('site.users.avatar.relative_path'). "{$comment->user->name}.$a" }}" class="comment__avatar__img" alt="{{ $comment->user->name }}">
                        @endif
                    </div>
                </div>
            </div>
            <div class="comment__user-name">{{ $comment->user->name }}</div>
            <div class="comment__datetime" title="{{ DateIntl::full('long', $comment->created_at) }}">{{ LocalizedCarbon::instance($comment->created_at)->diffForHumans() }}</div>
            <div class="comment__manage-buttons">
                @can('update', $comment)
                    <a href="{{  route( 'comment.update', [$comment]) }}" class="comment__change-button" title="Изменить комментарий"></a>
                @endcan
                @can('delete', $comment)
                    <a href="{{  route( 'comment.delete', [$comment]) }}" class="comment__delete-button" title="Удалить комментарий"></a>
                @endcan
            </div>
        </header>
        <div class="comment__text">{{ $comment->text }}</div>
        <footer class="comment__footer">
            @can('create', \App\Comment::class)
                <a class="comment__reply-link" href="">Ответить</a>@endcan
            @can('like', $comment)
                <a class="comment__likes__like" href="{{ route( 'comment.like', [$comment]) }}"></a>
            @else
                <div class="comment__likes__like"></div>
            @endcan
            <div class="comment__likes-num">{{ count($comment->likes) }}</div>
        </footer>
    </div>@foreach($comment->getReplies() as $comment)@include('comments.comment')@endforeach</div>@endspaceless