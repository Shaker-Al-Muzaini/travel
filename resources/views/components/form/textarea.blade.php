@props([
       'name','value' ,'label'=>false
])
@if($label)
    <label for="" style="font-weight: bold ;color: #131333">{{$label}}</label>
@endif
<textarea
    style="background-color: #dcdcdc;color:black"
    name="{{$name}}"
    {{$attributes->class([
        'form-control',
        'is-invalid'=> $errors->has($name)
    ])}}
    >{{old ($name,$value)}}
</textarea>
<x-form.error :name="$name" />
