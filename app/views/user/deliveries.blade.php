@extends('layout.' . Config::get('app.layout') . '.layout')

@section('content')
<div class="col-md-12">
    <h3 class="page-header">My deliveries</h3>
</div>

<div class="col-md-12">
    <div class="list-group">
        @foreach ($deliveries as $delivery)
            @include('user.deliveries.item', array('delivery' => $delivery))
        @endforeach
    </div>
</div>

@stop
  