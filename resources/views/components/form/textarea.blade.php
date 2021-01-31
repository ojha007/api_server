@php($a= $attributes['p'] ?? '12')
@php($b= $a !=12 ? 3 : 2)
@php($c=  $b != 2 ? 9 : 10)
@php($row = $attributes['r'] ?? '5')
<div class="form-group col-md-{{$a}} col-sm-12 @error($name) has-error @enderror">
    <div class="col-md-{{$b}} col-sm-12">
        {{ Form::label($name.":", null, ['class' => 'control-label']) }}
    </div>
    <div class="col-md-{{$c}} col-sm-12">
        {{ Form::textarea($name, $value, array_merge(
        [
        'class' => 'form-control',
        'rows'=>$row,
        'id'=>str_replace('_'," ",$name),
        'placeholder'=>'Enter ' . ucwords(str_replace('_'," ",$name))
        ],
        $attributes ?? []
    )) }}
    </div>
</div>
