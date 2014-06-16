@extends('layout.' . Config::get('app.layout') . '.layout')

@section('content')

	<div class="col-md-12">
		<div class="panel panel-default">

			<div class="list-group">

				@foreach ($stores as $store)
					<a href="{{ URL::route('store.dishes', ['id' => $store->id]) }}" class="list-group-item">
						<h4 class="list-group-item-heading">{{ $store->name }}</h4>
					</a>
				@endforeach

			</div>

		</div>
	</div>

@stop