@props([
        'type'=>'text','name','value'=>'','label'=>false
])
@if($label)
    <label for="" style="font-weight: bold ;color: #131333">{{$label}}</label>
@endif
<input
  style="background-color: #dcdcdc;color:black"
    type="{{$type}}"
    name="{{$name}}"
    value="{{old($name,$value)}}"
    {{$attributes->class([
        'form-control',
        'is-invalid'=> $errors->has($name)
])}}>
<x-form.error :name="$name" />
