@extends('layouts.template_inspi')
@section('page-title', 'Daftar Perkara')
@section('custom_css')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <div class="ibox-tools">
          <button class="btn btn-success" onclick="location.href='{{ route('perkara.create') }}'">Tambah Perkara</button>
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
                <th>Jumlah Berkas</th>
                <th width="1%">Action</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach ($perkaras as $perkara)
              <tr>
               <td>{{ $no++ }}</td>
               <td>{{ $perkara->no_perkara }}</td>
               <td>{{ $perkara->jenis_perkara->nama }}</td>
               <td>{{ count($perkara->berkas_perkara) }}</td>
               <td style="white-space: nowrap">

                <a href="{{ route('perkara.edit', $perkara->id) }}" class="btn btn-primary">Edit</a>
                <a onclick="deletePerkara('{{ $perkara->id }}')" class="btn btn-danger">Delete</a>

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
@endsection

@section('custom_js')
<script>
  let $tablePerkara = $("#table-perkara").DataTable();


  function deletePerkara(id) {
    swal({
      icon : 'warning',
      title : 'Hapus  Perkara ? ',
      text : 'Yakin Hapus Perkara ? ',
      buttons : {
        'Batal' : {
          className : 'btn btn-info'
        },
        'Hapus' : {
          className : 'btn btn-danger'

        }
      },
      closeOnClickOutside : false,
    })
    .then(btn => {
      if (btn == 'Hapus') {
       axios.post('{{ route('perkara.index') }}'+ '/' + id, {

        _method : 'DELETE',
        _token : '{{ csrf_token() }}',

      })
       .then(resp => {
        location.href = '{{ route('perkara.index') }}';
      })
     }

   });
  }
</script>
@endsection
