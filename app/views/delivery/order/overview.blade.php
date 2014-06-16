@extends('layout.' . Config::get('app.layout') . '.layout')

@section('content')
	<div class="col-md-12">
		<div class="panel panel-default">

			<div class="panel-heading">
				<h3 class="panel-title">
					<div class="text-right pull-right hidden-xs">

						<span class="label label-info">{{ $delivery->user->name }}</span>
						<span class="label label-primary">{{ $delivery->closing_time }}</span>

						@if ($delivery->is_active)
							<span class="label label-success">active</span>
						@else
							<span class="label label-danger">closed</span>
						@endif

					</div>
					{{ $delivery->store->name }}
				</h3>
			</div>

			<div class="panel-heading visible-xs">
				<h3 class="panel-title">
					<div class="text-left">
						<span class="label label-info">{{ $delivery->user->name }}</span>
						<span class="label label-primary">{{ $delivery->closing_time }}</span>

						@if ($delivery->is_active)
						<span class="label label-success">active</span>
						@else
						<span class="label label-danger">closed</span>
						@endif
					</div>
				</h3>
			</div>

			<div class="panel-body">
				Tel: {{ $delivery->store->phone_number }}<br>
				{{ $delivery->store->street }}<br>
				{{ $delivery->store->postcode }} {{ $delivery->store->city }}
			</div>

			<!-- orders -->
			<table class="table table-striped">
				<tr>
					<th class="text-right" style="width: 50px">#</th>
					<th>User</th>
					<th>Name</th>
					<th class="text-right" style="width: 100px">Price</th>

					<!-- desktop -->
					<th style="width: 100px" class="hidden-xs"></th>
					<th style="width: 100px" class="hidden-xs"></th>
					<th style="width: 100px" class="hidden-xs"></th>

					<!-- mobile -->
					<th style="width: 50px" class="visible-xs"></th>
					<th style="width: 50px" class="visible-xs"></th>
				</tr>
				@foreach ($delivery->orders as $order)
					<tr>
						<td class="text-right">{{ $order->dish->store_dish_id }}</td>
						<td>{{ $order->user->name }}</td>
						<td>{{ $order->dish->name }}</td>
						<td class="text-right">{{ Numbers::money($order->dish->price, 2) }}</td>

						<!-- desktop: toggle the paid status button -->
						<td class="text-center hidden-xs">
							@if ($order->paid)
								<span class="label label-success">paid</span>
							@else
								<span class="label label-danger">not paid</span>
							@endif
						</td>
						<td class="text-center hidden-xs">
							@if ($order->allowedToChangePaid(Auth::user()))
								{{ Form::open(['route' => ['order.change.paid', $order->id]]) }}
									@if ($order->paid)
										{{ Form::submit('mark as not paid', ['class' => 'btn btn-sm btn-primary']) }}
									@else
										{{ Form::submit('mark as paid', ['class' => 'btn btn-sm btn-primary']) }}
									@endif
								{{ Form::close() }}
							@endif
						</td>

						<!-- mobile: toggle the paid status button -->
						<td class="text-center visible-xs">
							@if ($order->allowedToChangePaid(Auth::user()))
								{{ Form::open(['route' => ['order.change.paid', $order->id]]) }}
									@if ($order->paid)
										<button type="submit" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-euro"></span></button>
									@else
										<button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-euro"></span></button>
									@endif
								{{ Form::close() }}
							@else
								@if ($order->paid)
									<button type="submit" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-euro"></span></button>
								@else
									<button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-euro"></span></button>
								@endif
							@endif
						</td>

						<td class="text-center">
							@if ($order->allowedToDelete(Auth::user()))
								{{ Form::open(['route' => ['order.delete', $order->id]]) }}

									<!-- desktop: delete button -->
									{{ Form::submit('delete', ['class' => 'btn btn-sm btn-danger hidden-xs delete-order']) }}

									<!-- mobile: delete button -->
									<button type="submit" class="btn btn-sm btn-danger visible-xs delete-order" data-toggle="modal" data-target="#modal-delete-order">
										<span class="glyphicon glyphicon-trash"></span>
									</button>

								{{ Form::close() }}
							@endif
						</td>
					</tr>
				@endforeach
				<tr>
					<td colspan="4" class="text-right">{{ Numbers::money($delivery->total_price, 2) }}</td>
					<td colspan="3"></td>
				</tr>
			</table>

		</div>
	</div>

@stop