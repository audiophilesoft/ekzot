<p>На сайте <a href="{{ config('site.address') }}">{{ config('site.name') }}</a> появился новый комментарий к материалу
    <a href="{{ $comment->commentable->getUrl() }}">{{ $comment->commentable->title }}</a> от пользователя {{ $comment->user->name }}. Текст комментария:</p>

<pre>{{ $comment->text }}</pre>