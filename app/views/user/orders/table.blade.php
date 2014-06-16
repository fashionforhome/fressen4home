<div class="table-responsive">
	<table class="table table-striped table-hover">
		<tr>
			<th>Date</th>
			<th>Store</th>
			<th>#</th>
			<th>Name</th>
			<th>Price</th>
			<th></th>
			<th></th>
		</tr>
		@foreach ($orders as $order)
			<tr>
				<td>{{{ $order->created_at }}}</td>
				<td>{{{ $order->delivery->store->name }}}</td>
				<td>{{{ $order->dish_id }}}</td>
				<td>{{{ $order->dish->name }}}</td>
				<td>{{{ Numbers::money($order->dish->price, 2) }}}</td>
				<td>
					@if ($order->paid)
					<span class="label label-success">paid</span>
					@else
					<span class="label label-danger">not paid</span>
					@endif
				</td>
				<td>
					@if ($order->delivery->is_active)
					<span class="label label-success">active</span>
					@else
					<span class="label label-danger">closed</span>
					@endif
				</td>
			</tr>
		@endforeach
	</table>
</div>