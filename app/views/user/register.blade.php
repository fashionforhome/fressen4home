@extends('layout.' . Config::get('app.layout') . '.layout')

@section('content')
	<div class="col-md-6 col-md-offset-3">

		{{ Form::open(array('route' => 'user.register')) }}
			<div class="form-group">
				{{ Form::label('email', 'Email address') }}
				{{ Form::email('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Enter email')) }}
			</div>
			<div class="form-group">
				{{ Form::label('password', 'Password') }}
				{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
			</div>
			<div class="form-group">
				{{ Form::label('password_confirmation', 'Password*') }}
				{{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Password*')) }}
			</div>
			<div class="form-group text-right">
				{{ Form::submit('Login', array('class' => 'btn btn-success')) }}
			</div>
		{{ Form::close() }}

	</div>
@stop