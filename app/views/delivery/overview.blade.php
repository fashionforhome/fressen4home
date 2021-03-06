@extends('layout.' . Config::get('app.layout') . '.layout')

@section('content')
	<div class="col-md-12">
		<div class="panel panel-default">

			<div class="panel-heading">

                @if ($delivery->user == Auth::user())
                    <div class="pull-right">
                        <a href="{{ route('delivery.incoming', [$delivery->getKey()])}}" class="btn btn-success btn-lg">Delivery Incoming</a>
                    </div>
                @endif

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
				<div class="pull-right text-right">
					{{ Form::open(['route' => ['delivery.close', $delivery->id]]) }}
						<button type="submit" class="btn btn-sm btn-warning" style="margin-bottom: 5px;"><span class="glyphicon glyphicon-off"></span> Close</button><br>
					{{ Form::close() }}
					{{ Form::open(['route' => ['delivery.delete', $delivery->id]]) }}
						<button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
					{{ Form::close() }}
				</div>
				Tel: {{ $delivery->store->phone_number }}<br>
				{{ $delivery->store->street }}<br>
				{{ $delivery->store->postcode }} {{ $delivery->store->city }}
			</div>

			<!-- orders -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th class="text-right" style="width: 50px">#</th>
                        <th>User</th>
                        <th>Name</th>
                        <th class="text-right" style="width: 100px">Price</th>

                        <th style="width: 50px">Paid</th>
                        <th style="width: 50px"></th>
                    </tr>
                    @foreach ($delivery->orders as $order)
                        <tr>
                            <td class="text-right">{{ $order->dish->store_dish_id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->dish->name }}</td>
                            <td class="text-right">{{ Numbers::money($order->dish->price, 2) }}</td>

                            <td>
                                @if ($order->allowedToChangePaid(Auth::user()))
                                    {{ Form::open(['route' => ['order.change.paid', $order->id]]) }}
                                        @if ($order->paid)
                                            <button type="submit" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span></button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                        @endif
                                    {{ Form::close() }}
                                @else
                                    @if ($order->paid)
                                        <button type="submit" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span></button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                    @endif
                                @endif
                            </td>

                            <td>
                                @if ($order->allowedToDelete(Auth::user()))
                                    {{ Form::open(['route' => ['order.delete', $order->id]]) }}
                                        <button type="submit" class="btn btn-sm">
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
	</div>

@stop