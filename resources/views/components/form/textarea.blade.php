
<div class="form-group col-md-12 col-sm-12 @error($name) has-error @enderror">
    <div class="col-md-2 col-sm-12">
        {{ Form::label($name.":", null, ['class' => 'control-label']) }}
    </div>
    <div class="col-md-9 col-sm-12">
        {{ Form::textarea($name, $value, array_merge(
        [
        'class' => 'form-control',
        'id'=>str_replace('_'," ",$name),
        'placeholder'=>'Enter ' . ucwords(str_replace('_'," ",$name))
        ],
        $attributes ?? []
    )) }}
    </div>
</div>
