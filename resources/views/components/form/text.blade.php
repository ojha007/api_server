<div class="form-group col-md-6 col-sm-12 @error($name) has-error @enderror">
    <div class="col-md-{{$attributes['p'] ?? '2'}} col-sm-12">
        {{ Form::label($name.":", null, ['class' => 'control-label']) }}
    </div>
    <div class="col-md-{{isset($attributes['p']) ?  12 -$attributes['p']  : '10'}} col-sm-12">
        {{ Form::text($name, $value, array_merge(
        [
        'class' => 'form-control',
        'placeholder'=>'Enter ' . ucwords(str_replace('_'," ",$name))
        ],
        $attributes ?? []
    )) }}
    </div>
</div>
