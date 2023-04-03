@props(
    [
        'type' => 'text',
        'name',
        'value' =>'',
        'label' =>''
    ]
)


@if ($label)
<label for="exampleFormControlInput1">{{$label}}</label>
@endif


<input type="{{$type}}"  id="exampleFormControlInput1"
     name="{{$name}}"



 {{$attributes->merge(['class'=>
 'form-control',
 'is-invalid'=>$errors->has($name)
  ])}}



     value="{{old($name) ?? $value}}">
     @error($name)
     <div  style="color: red">
        {{$message}}
     </div>

     @enderror
