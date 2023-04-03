@extends('layouts.layouts')

{{-- css --}}
@push('css')

@endpush
@section('title')
لوحة التحكم
@stop

@section('breadcrumb')
Starter Page
@endsection


@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div style="margin-bottom: 10px ; margin-left: 30px ">
  <a href="{{route('home')}}" class="btn btn-sm btn-outline-primary">Front Page</a>
    <!-- /.content-header -->
</div>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
  {{-- ****** --}}


  {{-- ******* --}}
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
