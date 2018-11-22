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

  <form action="{{ route('perkara.update', $perkara->id) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
    @csrf
    {{ method_field("PATCH") }}
    <div class="ibox-title">
      <h4>Form Tambah Perkara</h4>
    </div>

    <div class="ibox-content">
      <div class="form-group">
        <label for="" class="control-label col-lg-2">No Perkara</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" name="no_perkara" required value="{{ $perkara->no_perkara }}">
        </div>

      </div>
      <div class="form-group">
        <label for="" class="control-label col-lg-2">Jenis Perkara</label>
        <div class="col-lg-10">
          <select name="jenis_perkara_id" id="jenis_perkara_id" class="form-control">
            @foreach ($jenis as $jen)
            <option value="{{ $jen->id }}"

              @if($perkara->jenis_perkara_id == $jen->id)
              selectec
              @endif
              >{{ $jen->nama }}</option>
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
<form id="form-form"></form>
@endsection

@section('custom_js')
<script>
  let dataBerkas = JSON.parse('{!! $berkas !!}');

  let $wadah = $("#content-berkas");
  let $btnTambah = $("#btn-tambah");



  $btnTambah.click(generateRow);


  $.each(dataBerkas, function(index, val) {
    generateRow(val);
  });


  function generateRow(data)
  {
    console.log(data);

    data.berkas_id = data.id || '-';
    $elNama = '';
    $elBerkas = '';
    $tdHapus = '';
    $tdGanti = '';

    $inputFile = $("<input/>", {
      class : 'form-control',
      attr : {
       type : 'file',
       required : true,
       name : 'berkas[]',
     },

   });

    if (data.nama) {
      $elNama = $("<input/>", {
        class : 'form-control',
        placeholder : 'Isi nama disini...',
        value : data.nama,

        required : true,
        name : 'nama[]'

      });
    } else {
     $elNama = $("<input/>", {
      class : 'form-control',
      placeholder : 'Isi nama disini...',
      required : true,
      name : 'nama[]'

    });
   }

   if (! data.file) {
    $elBerkas = $inputFile;
    $tdHapus = $("<td/>", {
      class : 'text-center',
      attr : {
        rowspan: '1'
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

    }));

  } else {
    $elBerkas = $("<button/>", {
      class : 'btn btn-info',
      type : 'button',
      text : 'Lihat File'

    })
    .click(function(event) {
      //   var   newForm = jQuery('<form>', {
      //   'action' : '{{ route('perkara.read') }}',
      //   'target' : '_blank',
      //   'method' : 'post'
      // }).append(jQuery('<input>', {
      //   'name' : 'id',
      //   'value' : data.id,
      //   'type' : 'hidden'
      // }))
      // .append(jQuery('<input>', {
      //   'name' : '_token',
      //   'value' : '{{ csrf_token() }}',
      //   'type' : 'hidden'
      // }))
      // newForm.appendTo($('#form-form'));
      // newForm.submit();
      window.open('{{ url('storage/berkas-perkara') }}'+ '/' + data.file);
    })
    .add($inputFile.attr('required', false).hide());
    ;

    $tdHapus = $("<td/>", {
      class : 'text-center',
      attr : {
        rowspan: '1'
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

    }));

    $tdGanti = $("<td/>", {
      class : 'text-center',
      width : '1%',
      attr : {
        rowspan: '1'
      }
    })
    .append($("<button/>", {
      type : 'button',
      text : 'Ganti File',
      class : 'btn btn-warning btn-block',
      css : {
        'vertical-align': 'middle'
      }
    })
    .click(function(event) {
      let $el = $($(this).parent().prev());
      $el.find("button").toggle();
      $el.find("input").toggle();
      $(this).toggleClass('btn-warning');
      if ($(this).hasClass('btn-warning')) {
        $(this).text('Ganti File');
        $el.find("input").attr('required', false);
      } else
      {
        $el.find("input").attr('required', true);

        $(this).text('Batal');
      }


    }));
  }

  let rowData = $("<tr/>", {
    class : 'counter',
    
  })
  .append($("<input/>", {
    type : 'hidden',
    name : 'berkas_id[]',
    value : data.berkas_id,
  }))
  .append($("<th/>", {
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
    text : 'Nama',
    width : '1%'
  }))
  .append($("<td/>", {

  })
  .append($elNama)

  )

  .append($tdHapus)
  .add($("<tr/>", {
  })
  .append($("<th/>", {
    text : 'berkas'
  }))
  .append($("<td/>", {

  })
  .append($elBerkas))
  .append($tdGanti)

  );

  $wadah.append(rowData);
  genNumber();  
}

function genNumber() {
  let $el = $(".counter");
  let total = $el.length;
  $.each($el, function(index, val) {
    $($(val).find("th")[0]).text(index + 1);
  });
}
</script>
@endsection
