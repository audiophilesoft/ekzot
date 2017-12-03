<div class="form-group">
    {!!   Form::label('title', 'Заголовок', ['class' => 'col-sm-3 control-label']) !!}

    <div class="col-sm-6">
        {!! Form::text('title', null, ['class' => 'form-control', 'maxlength' => '255', 'required']) !!}
    </div>
</div>