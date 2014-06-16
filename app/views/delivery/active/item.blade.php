<a href="{{ URL::route('delivery.store.dishes', ['id' => $delivery->id]) }}" class="list-group-item">

	<span class="badge">{{ $delivery->orders->count() }}</span>

    <h4 class="list-group-item-heading">{{{ $delivery->store->name }}}</h4>
	<p class="list-group-item-text">
        <span class="label label-default">{{{ $delivery->remaining_time }}}</span>
        <span class="label label-info">{{{ $delivery->user->name }}}</span> is going
    </p>

</a>