@extends('layout.' . Config::get('app.layout') . '.layout')

@section('header')
	<script src="{{ asset('assets/js/delivery.js') }}"></script>

	<!-- datepicker -->
	<script src="{{ asset('assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
	<link href="{{ asset('assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@stop

@section('content')

	<div class="col-md-12">

		<h3 class="page-header">
			Open deliveries
			<a data-toggle="modal" data-target="#createForm" class="btn btn-success">create</a>
		</h3>
	</div>

	<div class="col-md-12">

		<div class="list-group">
			@foreach ($activeDeliveries as $delivery)
				@include('delivery.active.item', array('delivery' => $delivery))
			@endforeach
		</div>

		@include('delivery.create', ['now' => $now, 'stores' => $stores])

	</div>

@stop


  