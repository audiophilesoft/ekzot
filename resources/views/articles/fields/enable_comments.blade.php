<div class="form-group">
    {!!   Form::label('enable_comments', 'Включить комментарии', ['class' => 'col-sm-3 control-label']) !!}

    <div class="col-sm-6">
        {!! Form::checkbox('enable_comments', null, null, ['class' => 'checkbox']) !!}
    </div>
</div>