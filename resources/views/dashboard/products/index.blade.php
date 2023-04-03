@extends('layouts.layouts')

{{-- css --}}
@push('css')

@endpush
@section('title')
لوحة التحكم
@stop

@section('subtitle')
<b>products</b>
@endsection
@section('breadcrumb')
products
@endsection


@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div style="margin-bottom: 10px ; margin-left: 30px ">
  <a href="{{route('dashboard.Products.create')}}" class="btn btn-sm btn-outline-primary mr-2">Create</a>

    <!-- /.content-header -->
</div>

<div>
@if (session()->has('success'))
<div class="alert alert-primary" role="alert">
  {{session('success')}}
  </div>
@endif

@if (session()->has('delete'))
<div class="alert alert-danger" role="alert">
  {{session('delete')}}
  </div>
@endif

@if (session()->has('update'))
<div class="alert alert-success" role="alert">
  {{session('update')}}
  </div>
@endif

</div>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div>
            <form action="{{URL::current()}}" method="get" class="d-flex justify-cintent-between mx-2 my-2">
                <x-form.input name="name" aria-placeholder="Name" :value="request('name')"/>
                <select name="status" class="form-control mx-2" >
                    <option value="">All</option>
                    <option value="active">Active</option>
                    <option value="archived">Arcived</option>
                </select>
                <button type="submit" class="btn btn-dark mx-2">Filter</button>
            </form>
            </div>
            <table class="table">
                <thead>
                  <tr>

                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">Category</th>
                    <th scope="col">Store</th>
                    <th scope="col">Status</th>
                    <th scope="col">CREATE AT </th>
                    <th scope="col">Image</th>
                    <th colspan="2">Action </th>


                    </th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>{{$product->name}}</td>
                        <td>{{!empty($product->category) ? $product->category->name :''}}</td>
                        <td>{{$product->store->name}}</td>
                        <td>{{$product->status}}</td>
                        <td>{{$product->created_at}}</td>
                        <td> <img src="{{asset('storage/'. $product->image)}}" style="width:60px" alt=""></td>

                        <td>
                            <a href="{{route('dashboard.Products.edit',$product->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
                        </td>
                        <td>
                            <form action="{{route('dashboard.Products.destroy', $product->id)}}"  method="post">
                            @csrf
                            @method('Delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>

                            </form>


                        </td>
                      </tr>
                    @empty
                    <tr>
                        <td clospan="9">No recorde defined</td>
                    </tr>
                    @endforelse

                </tbody>
              </table>

              {{$products->withQueryString()->links()}}


              {{-- $products->links() pagination تستخدم لعمل صفحات لل --}}
              {{-- ->withQueryString()  تستخدم عشان احافظ على الفلتر عند التنقل بين الصفحات   --}}


          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  {{-- js --}}
@push('js')

@endpush

@endsection
