@extends('layouts.layouts')

{{-- css --}}
@push('css')

@endpush
@section('title')
 Create Categery
@stop

@section('subtitle')
<b> Create Categery</b>

@stop

@section('breadcrumb')
Categerois
<li class="breadcrumb-item active">Create</li>
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

<form action="{{route('dashboard.Categories.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('dashboard.Categories._form')
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
