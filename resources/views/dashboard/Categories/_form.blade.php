@if ($errors->any())
<div class="alert alert-danger">
    <h3>Error Occured!</h3>
<ul>
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</ul>

</div>
@endif



<div class="form-group">

    {{-- <x-forms.input label='Category Name' type="text" name="name" value="{{$Categories->name}}" role="input" /> --}}
     <x-form.input class="form-control-lg" label='Category Name' type="text" name="name" :value="$Categories->name" role="input" />

  </div>

  <div class="form-group">
    <x-form.label id="exampleFormControlSelect1">Parent Name</x-form.label>
    {{-- <label for="exampleFormControlSelect1">Parent Name</label> --}}
    <select class="form-control{{ $errors->has('parent_id') ? ' is-invalid' : '' }}" name="parent_id">
      <option value="" >Primary Category</option>
      @foreach ($parents as $parent)
          <option value="{{old('parent_id') ?? $parent->id}}" @if ($Categories->parent_id == $parent->id)
              selected
          @endif >{{$parent->name}}</option>
      @endforeach
    </select>
  </div>


      <div class="form-group">
        <x-form.input label="Image"  type="file" name="image" accept="image/*" />
        @if ($Categories->image)
        <img src="{{asset('storage/'.$Categories->image)}}" style="width:150px " alt="">
        @endif
      </div>

 <x-form.textarea  label="description" for="exampleFormControlTextarea1" name="description" :value="$Categories->description" />

    <x-form.radio type="radio" name="status"
    :options="['active'=>'Active','archived'=>'Archived']"
    checked="{{$Categories->status}}"
    />



    <button  class="btn btn-sm btn-success" type="submit">{{$button_lable ?? 'SAVE'}}</button>
