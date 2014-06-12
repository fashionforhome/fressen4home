
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Fressen 4 Home</title>

	<!-- libs -->
	<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
	<link href="{{ asset('assets/libs/twitterbootstrap3/css/bootstrap.min.css') }}" rel="stylesheet">
	<script src="{{ asset('assets/libs/twitterbootstrap3/js/bootstrap.min.js') }}"></script>

	<!-- css -->
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

<div class="container">

	<!-- Static navbar -->
	@include('layout.' . Config::get('app.layout') . '.navigation')

	<!-- error messages / notifications -->
	@include('layout.' . Config::get('app.layout') . '.messages', ['messages' => Session::get('messages'), 'type' => 'success'])
	@include('layout.' . Config::get('app.layout') . '.messages', ['messages' => Session::get('errors'), 'type' => 'danger'])

	<!-- content container -->
	<div class="row">
		@yield('content')
	</div>

</div> <!-- /container -->

</body>
</html>
