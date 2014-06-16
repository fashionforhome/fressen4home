@extends('layout.' . Config::get('app.layout') . '.layout')

@section('content')

	<div class="col-md-12">
		<div class="panel panel-default">

			<div class="panel-heading">
				<h3 class="panel-title">
					{{ $delivery->store->name }}
				</h3>

				<div class="text-left" style="margin-top:5px">
					<span class="label label-info">{{ $delivery->user->name }}</span>
					<span class="label label-primary">{{ $delivery->closing_time }}</span>

					@if ($delivery->is_active)
						<span class="label label-success">active</span>
					@else
						<span class="label label-danger">closed</span>
					@endif
				</div>
			</div>

			<div class="panel-body">
				Tel: {{ $delivery->store->phone_number }}<br>
				{{ $delivery->store->street }}<br>
				{{ $delivery->store->postcode }} {{ $delivery->store->city }}
			</div>

			<table class="table table-striped">
				<tr>
					<th class="text-right" style="width: 50px">#</th>
					<th>Name</th>
					<th class="text-right" style="width: 100px">Price</th>
					<th style="width: 100px"></th>
				</tr>
				@foreach ($delivery->store->dishes as $dish)
				<tr>
					<td class="text-right">{{ $dish->store_dish_id }}</td>
					<td>{{ $dish->name }}</td>
					<td class="text-right">{{ Numbers::money($dish->price, 2) }}</td>
					<td class="text-center">
						{{ Form::open(['route' => ['delivery.order.dish', $delivery->id, $dish->id]]) }}
							{{ Form::submit('order', ['class' => 'btn btn-sm btn-success']) }}
						{{ Form::close() }}
					</td>
				</tr>
				@endforeach
			</table>

		</div>
	</div>

@stop