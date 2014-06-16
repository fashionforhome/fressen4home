@extends('layout.' . Config::get('app.layout') . '.layout')

@section('content')
<h1 class="page-header">My Deliveries</h1>

<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr>
                <th style="width: 50px"></th>
                <th></th>
                <th>Store</th>
                <th>Date</th>
                <th>No. Orders</th>
                <th>Total Price</th>
            </tr>
            @foreach ($deliveries as $delivery)
            <tr data-link="{{ URL::route('delivery.overview', ['id' => $delivery->id]) }}">
                <td>
                    @if ($delivery->is_active)
                        <span class="label label-success">active</span>
                    @else
                        <span class="label label-danger">closed</span>
                    @endif
                </td>
                <td>{{{ $delivery->store->name }}}</td>
                <td>{{{ $delivery->created_at }}}</td>
                <td>{{{ $delivery->orders->count() }}}</td>
                <td>{{{ Numbers::money($delivery->total_price, 2) }}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('tr[data-link]').click(function() {
            window.location = this.dataset.link
        });
    })
</script>

@stop
  