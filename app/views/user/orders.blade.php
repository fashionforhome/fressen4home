@extends('layout.' . Config::get('app.layout') . '.layout')

@section('content')

	<div class="col-md-12">
		<h3 class="page-header">My Orders</h3>
	</div>


	<div class="col-md-12">

		<ul class="nav nav-tabs">
		    <li class="active"><a href="#open" data-toggle="tab">Open <span class="badge">{{{ $orderOpened->count() }}}</span></a></li>
		    <li><a href="#notpaid" data-toggle="tab">Not Paid <span class="badge">{{{ $orderNotPaid->count() }}}</span></a></li>
		    <li><a href="#bystore" data-toggle="tab">By Store <span class="badge">{{{ $orderByStore->count() }}}</span></a></li>
		    <li><a href="#all" data-toggle="tab">All <span class="badge">{{{ $orderAll->count() }}}</span></a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="open">
				@include('user.orders.table', ['orders' => $orderOpened])
			</div>
			<div class="tab-pane" id="notpaid">
				@include('user.orders.table', ['orders' => $orderNotPaid])
			</div>
			<div class="tab-pane" id="bystore">
				@include('user.orders.table', ['orders' => $orderByStore])
			</div>
			<div class="tab-pane" id="all">
				@include('user.orders.table', ['orders' => $orderAll])
			</div>
		</div>

	</div>

@stop