<div class="form-group col-md-6 col-sm-12">
    {{ Form::label($name, null, ['class' => 'control-label']) }}
    {{ Form::email($name, $value, array_merge(['class' => 'form-control'], $attributes ?? [])) }}
</div>
