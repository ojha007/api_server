@php($a= $attributes['p'] ?? '12')
@php($b= $a !=12 ? 3 : 2)
@php($c=  $b != 2 ? 9 : 10)
<div class="form-group col-md-{{$a}} col-sm-12 @error($name) has-error @enderror">
    <div class="col-md-{{$b}} col-sm-12">
        {{ Form::label($name.":", null, ['class' => 'control-label']) }}
    </div>
    <div class="col-md-{{$c}} col-sm-12">
        {{ Form::text($name, $value, array_merge(
        [
        'class' => 'form-control',
        'placeholder'=>'Enter ' . ucwords(str_replace('_'," ",$name))
        ],
        $attributes ?? []
    )) }}
    </div>
</div>
