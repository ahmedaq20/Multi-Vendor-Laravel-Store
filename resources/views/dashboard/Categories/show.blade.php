@extends('layouts.layouts')

{{-- css --}}
@push('css')

@endpush
@section('title')
لوحة التحكم
@stop

@section('subtitle')
<b>{{$Category->name}}</b>
@endsection
@section('breadcrumb')
{{$Category->name}}
@endsection


@section('content')
  <!-- Content Wrapper. Contains page content -->

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
 <!-- Main content -->
 <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          
    <table class="table">
        <thead>
          <tr>
            <th scope="col">NAME</th>
            <th scope="col">Store</th>
            <th scope="col">Status</th>
            <th scope="col">CREATE AT </th>

          </tr>
        </thead>
        <tbody>
            @php
              $products = $Category->products()->with('store')->latest()->paginate(5);
            @endphp
            @forelse ($products as $product)
            <tr>

                <td>{{$product->name}}</td>
                <td>{{$product->store->name}}</td>
                <td>{{$product->status}}</td>
                <td>{{$product->created_at}}</td>



              </tr>
            @empty
            <tr>
                <td clospan="4">No recorde defined</td>
            </tr>
            @endforelse

        </tbody>
      </table>
      {{$products->links()}}


              {{-- $categories->links() pagination تستخدم لعمل صفحات لل --}}
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
