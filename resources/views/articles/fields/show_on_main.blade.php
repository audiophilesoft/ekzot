<div class="form-group">
    {!!   Form::label('show_on_main', 'Показывать на главной', ['class' => 'col-sm-3 control-label']) !!}

    <div class="col-sm-6">
        {!! Form::checkbox('show_on_main', null, null, ['class' => 'checkbox']) !!}
    </div>
</div>