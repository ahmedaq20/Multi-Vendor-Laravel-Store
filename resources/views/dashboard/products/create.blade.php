@extends('layouts.layouts')

{{-- css --}}
@push('css')

@endpush
@section('title')
Create product
@stop

@section('subtitle')
Product
@stop

@section('breadcrumb')
Product
<li class="breadcrumb-item active">create</li>
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

<form action="{{route('dashboard.Products.create')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('post')

    @include('dashboard.Products._form',['button_lable' =>'create'])

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
