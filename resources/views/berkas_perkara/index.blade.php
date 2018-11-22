@extends('layouts.template_inspi')
@section('page-title', 'Daftar Berkas Perkara')
@section('custom_css')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <div class="ibox-tools">
          <!-- <button class="btn btn-success" onclick="location.href='{{ route('perkara.create') }}'">Tambah Perkara</button> -->
        </div>
      </div>
      <div class="ibox-content">
        <div class="table-responsive">
          <table class="table" id="table-perkara">
            <thead>
              <tr>
                <th>No </th>
                <th>No Perkara</th>
                <th>Jenis Perkara</th>
                <th>Nama Berkas</th>
                <th width="1%">Action</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach ($berkases as $berkas)
              <tr>
               <td>{{ $no++ }}</td>
               <td>{{ $berkas->perkara->no_perkara }}</td>
               <td>{{ $berkas->perkara->jenis_perkara->nama }}</td>
               <td>{{ $berkas->nama }}</td>
               <td style="white-space: nowrap">

                <a onclick="bacaBerkas('{{ $berkas->id }}')" class="btn btn-info">Read</a>

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div> <!-- end col -->
</div>

<form id="form-form"></form>

@endsection

@section('custom_js')
<script>
  let $tablePerkara = $("#table-perkara").DataTable();
  function bacaBerkas(id) {
    var   newForm = jQuery('<form>', {
      'action' : '{{ route('berkas_perkara.read') }}',
      'target' : '_blank',
      'method' : 'post'
    }).append(jQuery('<input>', {
      'name' : 'id',
      'value' : id,
      'type' : 'hidden'
    }))
    .append(jQuery('<input>', {
      'name' : '_token',
      'value' : '{{ csrf_token() }}',
      'type' : 'hidden'
    }))
    newForm.appendTo($('#form-form'));
    newForm.submit();
  }
</script>
@endsection
