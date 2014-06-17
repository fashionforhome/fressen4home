@extends('layout.' . Config::get('app.layout') . '.layout')

@section('content')

	<div class="col-md-12">
		<h3 class="page-header">Statistics</h3>
	</div>

	<div class="col-md-6">
		<ul class="list-group">
			<li class="list-group-item">
				<h3 class="panel-title"><span class="glyphicon glyphicon-home"></span> Favorite stores by spending</h3>
			</li>
			@foreach ($favoriteStoresBySpending as $key => $store)
				<li class="list-group-item">
					<span class="badge badge-success">{{ Numbers::money($store->spendByUser(Auth::user()), 2) }}</span>
					<span class="badge badge-primary">{{ $store->ordersByUser(Auth::user()) }} orders</span>
					<span class="badge badge-primary pull-left">{{ $key+1 }}.</span>
					{{ $store->name }}
				</li>
			@endforeach
		</ul>
	</div>

	<div class="col-md-6">
		<ul class="list-group">
			<li class="list-group-item">
				<h3 class="panel-title"><span class="glyphicon glyphicon-home"></span> Favorite stores by orders</h3>
			</li>
			@foreach ($favoriteStoresByOrderCount as $key => $store)
				<li class="list-group-item">
					<span class="badge badge-success">{{ Numbers::money($store->spendByUser(Auth::user()), 2) }}</span>
					<span class="badge badge-primary">{{ $store->ordersByUser(Auth::user()) }} orders</span>
					<span class="badge badge-primary pull-left">{{ $key+1 }}.</span>
					{{ $store->name }}
				</li>
			@endforeach
		</ul>
	</div>

	<div class="col-md-6">

		<ul class="list-group">
			<li class="list-group-item">
				<h3 class="panel-title"><span class="glyphicon glyphicon-euro"></span> Spendings</h3>
			</li>
			<li class="list-group-item">
				<span class="badge badge-success">{{ Numbers::money(Auth::user()->spend_last_week, 2) }}</span>
				last week
			</li>
			<li class="list-group-item">
				<span class="badge badge-success">{{ Numbers::money(Auth::user()->spend_last_month, 2) }}</span>
				last month
			</li>
			<li class="list-group-item">
				<span class="badge badge-success">{{ Numbers::money(Auth::user()->spend_last_year, 2) }}</span>
				last year
			</li>
		</ul>

	</div>

@stop