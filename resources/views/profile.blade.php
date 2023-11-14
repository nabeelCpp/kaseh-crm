@extends('layouts.app')


@section('content')


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


{!! Form::model(Auth::user(), ['method' => 'POST','route' => 'profile.update', 'enctype' => 'multipart/form-data']) !!}
<div class="row">
    @if(Auth::user()->image)
        <div class="profile clearfix">
            <div class="profile_pic">
            <img class="img-circle profile_img" src="{{ asset("storage/".Auth::user()->image) }}" alt="{{ Auth::user()->name }}" title="Profile image">
            </div>
        </div>
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image <small class="text-muted">(Optional)</small></strong><br>
            {!! Form::file('image', null, array('class' => 'form-control')) !!}
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
            <input type="text" readonly="" disabled="" value="{{ Auth::user()->email }}" class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Phone</strong>
            {!! Form::text('phone', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Date Of Birth <small class="text-muted">(Optional)</small></strong>
            {!! Form::date('dob', null, array('placeholder' => 'Date Of Birth','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</div>
{!! Form::close() !!}


@endsection
