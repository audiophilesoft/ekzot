<div class="form-group">
    {!!   Form::label('rank', 'Приоритет показа', ['class' => 'col-sm-3 control-label']) !!}

    <div class="col-sm-6">
        {!! Form::number('rank', '0', ['min' => '-128', 'max' => '127', 'class' => 'form-control']) !!}
    </div>
</div>