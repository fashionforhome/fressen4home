<div class="list-group">
    <a href="{{ URL::route('delivery.store.dishes', ['id' => $delivery->id]) }}" class="delivery list-group-item">
        <h4 class="list-group-item-heading">{{{ $delivery->store->name }}} <span class="badge">{{{ $delivery->remaining_time }}}</span></h4>
        <p class="list-group-item-text"><span class="label label-info">{{{ $delivery->user->name }}}</span> is going</p>
    </a>
</div>
