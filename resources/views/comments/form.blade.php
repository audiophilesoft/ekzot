<form method="post" action="{{ ($entry->catalogue ?  '../' : '' ) . 'add_comment/'.$entry->url }}" class="comments__form">
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
    <div class="comments__form__text-field-wrapper">
        <textarea name="text" minlength="{{ config('site.comments.min_size') }}" class="comments__form__text-field" maxlength="{{ config('site.comments.max_size') }}" placeholder="Введите текст комментария" rows="4" required></textarea>
    </div>
    <input type="submit" class="comments__form__submit-button" value="Отправить">
</form>