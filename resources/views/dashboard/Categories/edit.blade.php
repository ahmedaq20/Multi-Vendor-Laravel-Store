@extends('layouts.layouts')

{{-- css --}}
@push('css')

@endpush
@section('title')
Edit Category
@stop

@section('subtitle')
Category
@stop

@section('breadcrumb')
Categery
<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div style="margin-bottom: 10px ; margin-left: 30px ">

    <!-- /.content-header -->

</div>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
{{-- *** --}}

<form action="{{route('dashboard.Categories.update',$Categories->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('dashboard.Categories._form',['button_lable' =>'update'])

    </form>

</div>

{{-- *** --}}
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
