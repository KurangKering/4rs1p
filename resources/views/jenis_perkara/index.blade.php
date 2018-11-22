@extends('layouts.template_inspi')
@section('page-title', 'Jenis Perkara')
@section('custom_css')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <div class="ibox-tools">
          <button class="btn btn-success" onclick="location.href='{{ route('jenis_perkara.create') }}'">Tambah Jenis Perkara</button>
        </div>
      </div>
      <div class="ibox-content">
        <div class="table-responsive">
          <table class="table" id="table-jenis">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Perkara</th>
                <th width="1%">Action</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp
              @foreach ($jenis_perkara as $jenis)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $jenis->nama }}</td>
                <td style="white-space: nowrap">
                  <a href="{{ route('jenis_perkara.edit', $jenis->id) }}" class="btn btn-primary">Edit</a>
                  <a onclick="deleteJenis('{{ $jenis->id }}')" class="btn btn-danger">Delete</a>
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
  let $tableJenis = $("#table-jenis").DataTable();


  function deleteJenis(id) {
    swal({
      icon : 'warning',
      title : 'Hapus Jenis Perkara ? ',
      text : 'Yakin Hapus Jenis Perkara ? ',
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
       axios.post('{{ route('jenis_perkara.index') }}'+ '/' + id, {

          _method : 'DELETE',
          _token : '{{ csrf_token() }}',

       })
       .then(resp => {
        location.href = '{{ route('jenis_perkara.index') }}';
       })
      }

    });
  }
</script>
@endsection
