@extends('layout.' . Config::get('app.layout') . '.layout')

@section('header')
	<script src="{{ asset('assets/js/delivery.js') }}"></script>

	<!-- datepicker -->
	<script src="{{ asset('assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
	<link href="{{ asset('assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@stop

@section('content')
	<h4>Open deliveries:</h4>

	<ul class="col-md-6 col-md-offset-3 list-group">
	    @foreach ($activeDeliveries as $delivery)
	        @include('delivery.active.item', array('delivery' => $delivery))
	    @endforeach
	</ul>

	@include('delivery.create', ['now' => $now, 'stores' => $stores])
@stop


  