@extends('layouts.template_inspi')
@section('page-title', 'Ubah Jenis Perkara')
@section('custom_css')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
       @if (count($errors) > 0)

      <div class="alert alert-danger">

        <strong>Ooops!</strong> Ada Kesalahan.<br><br>

        <ul>

         @foreach ($errors->all() as $error)

         <li>{{ $error }}</li>

         @endforeach

       </ul>

     </div>

     @endif
    <div class="ibox float-e-margins">

      <div class="ibox-title">
        <h3>Form Ubah Jenis Perkara</h3>
      </div>
    

     <div class="ibox-content">
      <form action="{{ route('jenis_perkara.update', $jenis->id) }}" class="form" method="POST">
        @csrf
        {{ method_field('PATCH') }}

        <div class="form-group">
          <label for="" class="control-label">ID</label>
          <input type="text" class="form-control" readonly value="{{ $jenis->id }}">
        </div>
        <div class="form-group">
          <label for="" class="control-label">Nama</label>
          <input type="text" class="form-control" name="nama" value="{{ $jenis->nama }}">
        </div>
        <div class="form-group text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div> <!-- end col -->
</div>
@endsection

@section('custom_js')
<script>
  let $tableJenis = $("#table-jenis").DataTable();
</script>
@endsection
