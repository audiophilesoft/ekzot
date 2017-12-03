<div class="form-group">
    {!!   Form::label('meta_tags', 'Мета-теги', ['class' => 'col-sm-3 control-label']) !!}

    <div class="col-sm-6">
        {!! Form::text('meta_tags', null, ['class' => 'form-control', 'maxlength' => '255']) !!}
    </div>
</div>