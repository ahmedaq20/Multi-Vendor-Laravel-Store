@props([
    'for','name','value'=>'','label'=>false
])

<div >
    @if ($label)
    <label for="{{$for}}">{{$label}}</label>
    @endif

    <textarea
        name="{{$name}}"

        {{$attributes->merge(
            ['class' =>
            'form-control',
            'is-invalid' =>$errors->has('name'),
       ] )}}

        >{{old($name,$value)}}</textarea>
  </div>
