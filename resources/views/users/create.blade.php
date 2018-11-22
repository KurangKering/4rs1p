@extends('layouts.template_inspi')
@section('page-title', 'Tambah Pengguna')
@section('custom_css')

@endsection
@section('content')
<div class="ibox float-e-margins">
  
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
 <div class="ibox-content">


   {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}

   <div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

      <div class="form-group">

        <strong>Username:</strong>

        {!! Form::text('username', null, array('placeholder' => 'Username','class' => 'form-control')) !!}

      </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

      <div class="form-group">

        <strong>Name:</strong>

        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}

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

    <div class="col-xs-12 col-sm-12 col-md-12">

      <div class="form-group">

        <strong>Hak Akses:</strong>

        {!! Form::select('roles', $roles,null, array('class' => 'form-control')) !!}

      </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

      <div class="form-group">

        <strong>Status:</strong>

        {!! Form::select('status', Config::get('enums.status_user'),null, array('class' => 'form-control')) !!}

      </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

      <button type="submit" class="btn btn-info">Submit</button>

    </div>

  </div>

  {!! Form::close() !!}




</div>
</div>
@endsection

@section('custom_js')

@endsection
