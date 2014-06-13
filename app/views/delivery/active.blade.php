@extends('layout.' . Config::get('app.layout') . '.layout')

@section('header')
<script src="{{ asset('assets/js/delivery.js') }}"></script>
@stop

@section('content')
<h4>Open deliveries:</h4>

<ul class="col-md-6 col-md-offset-3 list-group">
    @foreach ($activeDeliveries as $delivery)
        @include('delivery.active.item', array('delivery' => $delivery))
    @endforeach
</ul>

<input type="submit" class="col-md-6 col-md-offset-3 btn btn-sm btn-success" value="create">
@stop


  