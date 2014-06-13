@extends('layout.' . Config::get('app.layout') . '.layout')

@section('header')
	<!-- js -->
	<script src="{{ asset('assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
	
	<!-- css -->
	<link href="{{ asset('assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="col-md-6">
	<h3>Create a Delivery:</h3>
</div>
<div class="col-md-6 col-md-offset-1">
	
	<form class="create-delivery-form" action="{{URL::action('DeliveryController@postCreate')}}" method="post" role="form">
		<div class="form-group">
			<div>
				<label for="store-selector">Where you want to get the food?</label>
				<select class="form-control" id="store-selector" name="store">
					@foreach ($stores as $store)
						<option value="{{ $store->id }}">{{ $store->name }} ( {{$store->street}} )</option>
					@endforeach
				</select>
			</div>
			<br />
			<div>
				<label for="datetime-selector">When should the order window close?</label>
				<div class="input-append  " id="datetime-selector">
					<input size="18" type="text" name="closing_time" value="{{$now}}" class="date form_datetime" readonly>
					<span class="add-on"><i class="icon-th"></i></span>
				</div>
			</div>
			<br />
			<button type="submit" class="btn btn-success">Submit</button>
			
			<script type="text/javascript">
				$(".form_datetime").datetimepicker({
					format: "yyyy-mm-dd hh:ii",
					autoclose: true,
					startDate: "{{$now}}"
				});
			</script>
		</div>
	</form>
</div>
@stop