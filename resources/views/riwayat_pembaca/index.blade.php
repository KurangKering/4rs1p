@extends('layouts.template_inspi')
@section('page-title', 'Riwayat Pembaca')
@section('custom_css')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <div class="ibox-tools">
          
        </div>
      </div>
      <div class="ibox-content">
        <div class="table-responsive">
          <table class="table" id="table-perkara">
            <thead>
              <tr>
                <th>No </th>
                <th>Nama Pembaca</th>
                <th>No Perkara</th>
                <th>Nama Berkas</th>
                <th>Tanggal Akses</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach ($riwayats as $riwayat)
              <tr>
               <td>{{ $no++ }}</td>
               <td>{{ $riwayat->nama_pembaca }}</td>
               <td>{{ $riwayat->no_perkara }}</td>
               <td>{{ $riwayat->nama_berkas }}</td>
               <td>{{ indonesian_date($riwayat->tanggal, 'j F Y, H:i:s') }}</td>
               
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
  let $tablePerkara = $("#table-perkara").DataTable({
    order : [],
  });


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
