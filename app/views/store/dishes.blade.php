@extends('layout.' . Config::get('app.layout') . '.layout')

@section('content')

	<div class="col-md-12">
		<div class="panel panel-default">

			<div class="panel-heading">
				<h3 class="panel-title">
					{{ $store->name }}
				</h3>
			</div>

			<div class="panel-body">
				Tel: {{ $store->phone_number }}<br>
				{{ $store->street }}<br>
				{{ $store->postcode }} {{ $store->city }}
			</div>

			<div class="table-responsive">
				<table class="table table-striped">
					<tr>
						<th class="text-right" style="width: 50px">#</th>
						<th>Name</th>
						<th class="text-right" style="width: 100px">Price</th>
					</tr>
					@foreach ($store->dishes as $dish)
						<tr>
							<td class="text-right">{{ $dish->store_dish_id }}</td>
							<td>{{ $dish->name }}</td>
							<td class="text-right">{{ Numbers::money($dish->price, 2) }}</td>
						</tr>
					@endforeach
				</table>
			</div>

		</div>
	</div>

@stop