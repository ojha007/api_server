<div class="form-group col-md-6 col-sm-12 @error($name) has-error @enderror">
    {{ Form::label($name.":", null, ['class' => 'control-label']) }}
    {{ Form::text($name, $value, array_merge(
        [
        'class' => 'form-control',
        'placeholder'=>'Enter ' . ucwords(str_replace('_'," ",$name))
        ],
        $attributes ?? []
    )) }}

</div>
