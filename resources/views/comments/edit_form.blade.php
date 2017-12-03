@spaceless
<div class="comment__edit">
    <div class="comment__text" contenteditable="true">{{ $comment->text }}</div>
    <div class="comment__edit__form__buttons">
        <button form="comment{{ $comment->id }}__edit-form" type="submit" class="comment__edit__form__buttons__save">Сохранить</button>
        <button type="button" class="comment__edit__form__buttons__cancel">Отмена</button>
    </div>
    <form method="post" action="{{ route('comment.update', [$comment]) }}" class="comment__edit-form" id="comment{{ $comment->id }}__edit-form">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <input name="_method" type="hidden" value="patch">
    </form>
</div>
@endspaceless