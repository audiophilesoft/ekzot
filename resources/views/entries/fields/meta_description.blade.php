<div class="form-group">
    {!!   Form::label('meta_description', 'Мета-описание', ['class' => 'col-sm-3 control-label']) !!}

    <div class="col-sm-6">
        {!! Form::text('meta_description', null, ['class' => 'form-control', 'maxlength' => '255']) !!}
    </div>
</div>