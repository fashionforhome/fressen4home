@extends('layout.' . Config::get('app.layout') . '.layout')

@section('content')
	<div class="col-md-6 col-md-offset-3">

		{{ Form::open(['route' => 'user.login']) }}
			<div class="form-group">
				{{ Form::label('email', 'Email address') }}
				{{ Form::email('email', Input::old('email'), ['class' => 'form-control', 'placeholder' => 'Enter email']) }}
			</div>
			<div class="form-group">
				{{ Form::label('password', 'Password') }}
				{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
			</div>
			<div class="form-group text-right">
				{{ Form::submit('Login', ['class' => 'btn btn-success']) }}
			</div>
		{{ Form::close() }}

	</div>
@stop