
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Arsip</title>

    <link href="{{ asset('templates/inspinia_271/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/inspinia_271/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/inspinia_271/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/inspinia_271/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/inspinia_271/css/style.css') }}" rel="stylesheet">

    <style>
    .loginscreen.middle-box {
     width: 400px; 
 }
</style>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>


            </div>

            <h3>Form Pendaftaran Akun</h3>
            <div id="error-message">

            </div>

            <form class="m-t" method="POST" action="{{ route('daftar_store') }}" aria-label="{{ __('Register') }}">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control " placeholder="Nama" name="name" id="name" value="{{ old('name') }}"  autofocus >
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username" value="{{ old('username') }}" >
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="{{ old('email') }}" >
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" >
                </div>
                <div class="form-group">
                    <input id="confirm-password" placeholder="Confirm Password" type="password" class="form-control" name="confirm-password" >
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Daftar</button>

                <p class="text-muted text-center"><small>Sudah Punya Akun?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Login</a>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('templates/inspinia_271/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('templates/inspinia_271/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/axios/dist/axios.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('templates/inspinia_271/js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });

        $("form").submit(function(event) {
            $('#error-message').html("");

            $("button[type='submit']").attr('disabled', true);
            event.preventDefault();
            $("input").parent().removeClass('has-error');
            let formData = $(this).serialize();
            axios.post($(this).attr('action'), formData )
            .then(res => {
                swal({
                    icon : 'success',
                    title : 'Berhasil Daftar',
                    text : 'Silahkan Tunggu Konfirmasi Admin',
                    buttons : false,
                    closeOnClickOutside : false,
                    timer : 2000
                })
                .then(btn => {
                    location.href='{{ route('login') }}';
                });
                $("button[type='submit']").attr('disabled', false);

            })
            .catch(err => {
                let list= '';
                $.each(err.response.data.errors, function(index, val) {
                    $.each(val, function(index2, val2) {
                        console.log(val2);
                        list += "<p>" + val2 + "</p>";
                    });
                });
                $("#error-message").html(
                 "<div class=\"alert alert-danger\">\
                 "+list+"\
                 </div>\
                 ");
                $("button[type='submit']").attr('disabled', false);

            });
        });
    </script>
</body>

</html>
