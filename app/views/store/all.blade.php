@extends('layout.' . Config::get('app.layout') . '.layout')

@section('content')

	<div class="col-md-12">
		<div class="panel panel-default">

			<ul class="list-group">

				@foreach ($stores as $store)
					<li class="list-group-item"><a href="{{ URL::route('store.dishes', ['id' => $store->id]) }}">{{ $store->name }}</a></li>
				@endforeach

			</ul>

		</div>
	</div>

@stop