@extends('layouts.template_inspi')
@section('page-title', 'Tambah Perkara')
@section('custom_css')
<style>
.va-middle {
  vertical-align: middle;
  
}  
</style>

@endsection
@section('content')
<div class="row">
  <div class="col-sm-8 col-sm-offset-2">
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

  <form action="{{ route('perkara.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="ibox-title">
      <h4>Form Tambah Perkara</h4>
    </div>

    <div class="ibox-content">
      <div class="form-group">
        <label for="" class="control-label col-lg-2">No Perkara</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" name="no_perkara" required>
        </div>

      </div>
      <div class="form-group">
        <label for="" class="control-label col-lg-2">Jenis Perkara</label>
        <div class="col-lg-10">
          <select name="jenis_perkara_id" id="jenis_perkara_id" class="form-control">
            @foreach ($jenis as $jen)
            <option value="{{ $jen->id }}">{{ $jen->nama }}</option>
            @endforeach
          </select>
        </div>


      </div>
    </div>
    <div class="ibox-title">
      <h5>Data Berkas </h5>
      <div class="ibox-tools">
        <button type="button" class="btn btn-primary" id="btn-tambah">
          +
        </button>
      </div>
    </div>

    <div class="ibox-content">
      <table class="table table-bordered" id="table-berkas">
        <tbody id="content-berkas">

        </tbody>

      </table>
    </div>
    <div class="ibox-content">
      <div class="text-center">
        <button class="btn btn-success" type="submit">Simpan</button>
      </div>
    </div>
  </form>
</div>
</div> 
</div>
@endsection

@section('custom_js')
<script>

  // `<div class="fileinput fileinput-new input-group" data-provides="fileinput"> //
  // <div class="form-control" data-trigger="fileinput"> //
  // <i class="glyphicon glyphicon-file fileinput-exists"></i>
  // <span class="fileinput-filename"></span>
  // </div>
  // <span class="input-group-addon btn btn-default btn-file">
  // <span class="fileinput-new">Select file</span>
  // <span class="fileinput-exists">Change</span>
  // <input type="file" name="..."/>
  // </span>
  // <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
  // </div> `;

  // $("<div/>", {
  //   class:"fileinput fileinput-new input-group",
  //   'data-provides' :"fileinput",
  // })
  // append($("<div/>", {
  //   class:"form-control",
  //   'data-trigger':"fileinput",
  // })
  // .append(`
  //   <i class="glyphicon glyphicon-file fileinput-exists"></i>
  //   <span class="fileinput-filename"></span>
  //   `)
  // )
  // append($("<span/>", {
  //   class :"input-group-addon btn btn-default btn-file",
  // })
  // .append(`
  //   <span class="fileinput-new">Select file</span>
  //   <span class="fileinput-exists">Change</span>
  //   `)
  // .append($("<input/>", {
  //   type : 'file',
  // }))
  // )
  // .append(`<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>`);


  let $tableJenis = $("#table-jenis").DataTable();
  let arrBerkas = [];

  $("#btn-tambah").click(function(event) {
    let trSatu = $("<tr/>", {
      class : 'counter'
    });
    trSatu.append($("<th/>", {
      class : 'text-center',
      width : '1%',
      attr : {
        rowspan : '2',
      },
      css : {
        'vertical-align' : 'middle'
      }
    }))
    .append($("<th/>", {
      width : '1%',

      text : 'Nama',
    }))
    .append($("<td/>", {

    })
    .append($("<input/>", {
      class : 'form-control',
      
      attr : {
        placeholder : 'Isi nama disini...',
        required : true,
        name : 'nama[]'
      },

    })

    ))
    .append($("<td/>", {
      class : 'text-center',
      width : '1%',
      attr : {
        rowspan: '2'
      }
    })
    .append($("<button/>", {
      text : 'Hapus',
      class : 'btn btn-danger btn-block',
      css : {
        'vertical-align': 'middle'
      }
    })
    

    .click(function(event) {
      $(this).closest('tr').next('tr').remove();
      $(this).closest('tr').remove();
      genNumber();

    })
    ));
    let trDua = $("<tr/>", {
    })
    .append($("<th/>", {
      text : 'berkas'
    }))
    .append($("<td/>", {

    })

    .append($("<div/>", {
      class:"fileinput fileinput-new input-group",
      'data-provides' :"fileinput",
    })
    .append($("<div/>", {
      class:"form-control",
      'data-trigger':"fileinput",
    })
    .append(`
      <i class="glyphicon glyphicon-file fileinput-exists"></i>
      <span class="fileinput-filename"></span>
      `)
    )
    .append($("<span/>", {
      class :"input-group-addon btn btn-default btn-file",
    })
    .append(`
      <span class="fileinput-new">Select file</span>
      <span class="fileinput-exists">Change</span>
      `)
    .append($("<input/>", {
      type : 'file',
      required : true,
      name : 'berkas[]',
    })
    .change(function() {
      var file = this.files[0];
      var fileType = file.type;
      var match = "application/pdf";
      if (fileType != match) {
        $(this).val('');
        swal({
          icon : 'warning',
          text : 'Hanya File PDF',
          buttons : false,
          timer : 1000,
        })
      }
    })
    )
    )
    .append(`<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>`))); 

    //  .append($("<input/>", {
     //    class : 'form-control',
     //    attr : {
       //     type : 'file',
       //     required : true,
       //     name : 'berkas[]',
       //   },

       // }))
       // );

       let con =  trSatu.add(trDua);
       $("#content-berkas").append(con);

       genNumber();
     });


  function genNumber() {
    let $el = $(".counter");
    let total = $el.length;
    $.each($el, function(index, val) {
      $($(val).find("th")[0]).text(index + 1);
    });
  }



// <tr>
// <th rowspan="2" style="vertical-align: middle">1</th>
// <th style="vertical-align: middle">Nama</th>
// <td><input placeholder="Isi Nama Berkas Disini" type="text" class="form-control"></td>
// <td rowspan="2" style="vertical-align: middle"><button type="button" class="btn btn-warning btn-block">Hapus</button></td>
// </tr>
// <tr>
// <th>Berkas</th>
// <td><input type="file" class="form-control"></td>
// </tr>
</script>
@endsection
