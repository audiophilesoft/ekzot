<div class="form-group">
    {!!   Form::label('description', 'Анонс', ['class' => 'col-sm-3 control-label']) !!}

    <div class="col-sm-6">
        {!! Form::textarea('description', null, ['rows' => 4, 'class' => 'form-control', 'maxlength' => '4096', 'required']) !!}
    </div>
</div>