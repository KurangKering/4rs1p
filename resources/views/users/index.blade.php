@extends('layouts.template_inspi')
@section('page-title', 'Pengguna')
@section('custom_css')

@endsection
@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <div class="ibox-tools">
          <button class="btn btn-success" onclick="location.href='{{ route('users.create') }}'">Tambah Pengguna</button>
          
        </div>
      </div>
      <div class="ibox-content">
        <div class="table-responsive">
          <table id="tbl-user"  class="table table-striped">
            <thead>
             <tr>
               <th>Nama</th>
               <th>Username</th>
               <th>Email</th>
               <th>Hak Akses</th>
               <th>Status</th>
               <th>Action</th>
             </tr>
           </thead>
           <tbody>
             @foreach ($data as $key => $user)
             <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->username }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                {{ $v }}
                @endforeach
                @endif
              </td>
              <td>
                {{ Config::get('enums.status_user')[$user->status] }}
              </td>
              <td style="white-space: nowrap; width: 1%">
                @if (Auth::check())
                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                @if (! (Auth::user()->id == $user->id))
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
                @endif
                @endif

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
  let $table= $("#tbl-user").DataTable();

  $('form').on('click', 'input[type="submit"]', function(e) {
    e.preventDefault();

    swal({
      icon : 'warning',
      title : 'Hapus User!',
      text : 'yakin ingin menghapus user ini ?',
      buttons : {
        'Batal' : {
          className : 'btn btn-inverse'
        },
        'Hapus' : {
          className : 'btn btn-danger'
        },
      },
      closeOnClickOutside : false
    })
    .then(clicked => {
      if (clicked == 'Hapus') {
        $(this).parent().submit();
      }

    })

    ;
    
  });
  
</script>
@endsection
