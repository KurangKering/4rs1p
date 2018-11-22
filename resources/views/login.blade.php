
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Arsip</title>

	<link href="{{ asset('templates/inspinia_271/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('templates/inspinia_271/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

	<link href="{{ asset('templates/inspinia_271/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('templates/inspinia_271/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

	<div class="middle-box text-center loginscreen animated fadeInDown">
		<div>
			<div>

				<h1 class="logo-name"></h1>

			</div>
			<h3>Welcome to Arsip</h3>
			
			
			@if (count($errors) > 0)

			<div class="alert alert-danger text-center">
				@foreach ($errors->toArray() as $k => $v)
				@foreach ($v as $err)
				<p>{{ $err }}</p>
				@endforeach

				@endforeach

			</div>

			@endif
			<form class="m-t" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
				@csrf
				<div class="form-group">
					<input id="username" type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}" required autofocus>
				</div>
				<div class="form-group">


					<input id="password" type="password" class="form-control" placeholder="password" name="password" required>



				</div>
				<button type="submit" class="btn btn-primary block full-width m-b">Login</button>

				<p class="text-muted text-center"><small>Belum Punya Akun?</small></p>
				<a class="btn btn-sm btn-white btn-block" href="{{ url('daftar') }}">Daftar Disini</a>
			</form>
			
		</div>
	</div>

	<!-- Mainly scripts -->
	<script src="{{ asset('templates/inspinia_271/js/jquery-3.1.1.min.js') }}"></script>
	<script src="{{ asset('templates/inspinia_271/js/bootstrap.min.js') }}"></script>

</body>

</html>
