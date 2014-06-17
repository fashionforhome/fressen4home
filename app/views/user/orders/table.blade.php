<div class="list-group">
    @foreach ($orders as $order)
    <a href="{{ URL::route('delivery.overview', ['id' => $order->delivery->id]) }}" class="list-group-item">

        @if ($order->paid == 0)
        <span class="badge">unpaid</span>
        @endif

        <h4 class="list-group-item-heading">{{{ $order->delivery->store->name }}} <br /><small>{{{ $order->created_at }}}</small></h4>
        <p class="list-group-item-text">
            <p>
                @if ($order->delivery->is_active)
                <span class="label label-success">active</span>
                @else
                <span class="label label-danger">closed</span>
                @endif

                <span class="label label-info">{{{ $order->delivery->user->name }}}</span>
            </p>
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th style="width: 50px">#</th>
                    <th style="width: 100px">Dish</th>
                    <th style="width: 50px">Price</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{{ $order->dish->store_dish_id }}}</td>
                    <td>{{{ $order->dish->name }}}</td>
                    <td>{{{ Numbers::money($order->dish->price, 2) }}}</td>
                </tr>
                </tbody>
            </table>
        </p>
    </a>
    @endforeach
</div>