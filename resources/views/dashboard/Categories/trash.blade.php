@extends('layouts.layouts')

{{-- css --}}
@push('css')

@endpush
@section('title')
لوحة التحكم
@stop

@section('subtitle')
<b>Categories</b>
@endsection
@section('breadcrumb')
Categories/Trach
@endsection


@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div style="margin-bottom: 10px ; margin-left: 30px ">
  <a href="{{route('dashboard.Categories.index')}}" class="btn btn-sm btn-outline-primary">Backe</a>
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

            <table class="table">
                <thead>
                  <tr>

                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">Trached AT</th>
                    <th scope="col">Status</th>
                    <th scope="col">CREATE AT </th>
                    <th scope="col">Image</th>
                    <th colspan="2">Action </th>


                    </th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $categorie)
                    <tr>
                        <th scope="row">{{$categorie->id}}</th>
                        <td>{{$categorie->name}}</td>
                        <td>{{$categorie->deleted_at}}</td>
                        <td>{{$categorie->status}}</td>
                        <td>{{$categorie->created_at}}</td>
                        <td> <img src="{{asset('storage/'. $categorie->image)}}" style="width:60px" alt=""></td>

                        <td>
                            <form action="{{route('dashboard.Categories.restore', $categorie->id)}}"  method="post">
                                @csrf
                                @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>

                                </form>

                        </td>
                        <td>
                            <form action="{{route('dashboard.Categories.forcedelete', $categorie->id)}}"  method="post">
                            @csrf
                            @method('Delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>

                            </form>


                        </td>
                      </tr>
                    @empty
                    <tr>
                        <td clospan="7">No recorde Trash</td>
                    </tr>
                    @endforelse

                </tbody>
              </table>

              {{$categories->withQueryString()->links()}}


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
