<a data-toggle="modal" data-target="#createForm" class="col-md-6 col-md-offset-3 btn btn-sm btn-success">create</a>

<div class="modal fade" id="createForm">
	<div class="modal-dialog">

		<form class="create-delivery-form" action="{{URL::route('delivery.create')}}" method="post" role="form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Create new delivery</h4>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="store-selector">Where you want to get the food?</label>
						<select class="form-control" id="store-selector" name="store">
							@foreach ($stores as $store)
							<option value="{{ $store->id }}">{{ $store->name }} ( {{$store->street}} )</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="datetime-selector">When should the order window close?</label>
						<div class="input-append  " id="datetime-selector">
							<input size="18" type="text" name="closing_time" value="{{$now}}" class="date form_datetime" readonly>
							<span class="add-on"><i class="icon-th"></i></span>
						</div>
					</div>
					<script type="text/javascript">
						$(function(){
							$(".form_datetime").datetimepicker({
								format: "yyyy-mm-dd hh:ii:ss",
								autoclose: true,
								startDate: "{{$now}}"
							});
						});
					</script>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Create</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</form>

	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->