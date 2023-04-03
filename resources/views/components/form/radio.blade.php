@props([
    'name',
    'value'=>'',
    'type'=>'radio',
    'text',
    'checked'=>false,
    'options'


])
@foreach ($options as $value=>$text)


<div class="form-check">
    <input class="form-check-input" type="{{$type}}" name="{{$name}}" value="{{$value}}"

    @if ($checked == '{{$value}}')
    checked
    @endif




    @error('{{$name}}')
      {{$message}}
    @enderror >
    <label class="form-check-label" >
    {{$text}}
    </label>
  </div>

  @endforeach


