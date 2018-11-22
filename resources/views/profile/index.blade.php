@extends('layouts.template_inspi')
@section('page-title', 'Profile')

@section('custom_css')
<style type="text/css" media="screen">
#pas_photo {
	width: 250px;
	height: 250px;
}
</style>
@endsection
@section('content')
{!! Form::model($user, ['method' => 'POST','route' => ['profile.update'], 'enctype' => 'multipart/form-data']) !!}

<div class="row">
	
	<div class="col-md-8 col-md-offset-2 ">
		@if (count($errors) > 0)

		<div class="alert alert-danger">

			@foreach ($errors->all() as $error)

			<p>{{ $error }}</p>

			@endforeach

		</div>

		@endif
		<div class="ibox float-e-margins">
			
			<div class="ibox-content">


				<div class="row">
					

					<div class="col-xs-12 col-sm-12 col-md-12">

						<div class="form-group">

							<strong>Nama:</strong>

							{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}

						</div>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">

						<div class="form-group">

							<strong>Username:</strong>

							{!! Form::text('username', null, array('placeholder' => 'Username','class' => 'form-control')) !!}

						</div>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">

						<div class="form-group">

							<strong>Email:</strong>

							{!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}

						</div>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">

						<div class="form-group">

							<strong>Hak Akses:</strong>

							<input type="text" class="form-control" disabled value="{{ implode($user->getRoleNames()->toArray()) }}">
						</div>

					</div>

					<div class="col-xs-12 col-sm-12 col-md-12">

						<div class="form-group">

							<strong>Password:</strong>

							{!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}

						</div>

					</div>

					<div class="col-xs-12 col-sm-12 col-md-12">

						<div class="form-group">

							<strong>Confirm Password:</strong>

							{!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}

						</div>

					</div>
					<button type="submit" class="btn btn-primary btn-block">Submit</button>





				</div>

			</div>



		</div>
	</div>
	
	
</div>
{!! Form::close() !!}

@endsection
@section('custom_js')
@endsection