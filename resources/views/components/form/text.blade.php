<div class="form-group col-md-12 col-sm-12 @error($name) has-error @enderror">
    <div class="col-md-2 col-sm-12">
        {{ Form::label($name.":", null, ['class' => 'control-label']) }}
    </div>
    <div class="col-md-9 col-sm-12">
        {{ Form::text($name, $value, array_merge(
        [
        'class' => 'form-control',
        'placeholder'=>'Enter ' . ucwords(str_replace('_'," ",$name))
        ],
        $attributes ?? []
    )) }}
    </div>
</div>
