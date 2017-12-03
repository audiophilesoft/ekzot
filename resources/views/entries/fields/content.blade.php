<div class="form-group">
    {!!   Form::label('content', 'Текст', ['class' => 'col-sm-3 control-label']) !!}

    <div class="col-sm-6">
        {!! Form::textarea('content', null, ['rows' => 10, 'class' => 'form-control', 'maxlength' => '65535', 'required']) !!}
    </div>
</div>