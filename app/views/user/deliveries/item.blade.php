<a href="{{ URL::route('delivery.overview', ['id' => $delivery->id]) }}" class="list-group-item">

    @if ($delivery->orders()->unpaid()->count() > 0)
        <span class="badge">{{{ $delivery->orders()->unpaid()->count() }}} unpaid</span>
    @endif

    <h4 class="list-group-item-heading">{{{ $delivery->store->name }}} <small>{{{ $delivery->created_at }}}</small></h4>
    <p class="list-group-item-text">
        @if ($delivery->is_active)
            <span class="label label-success">{{{ $delivery->remaining_time }}}</span>
        @else
            <span class="label label-danger">closed</span>
        @endif
    </p>

</a>