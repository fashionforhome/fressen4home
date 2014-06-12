@if (is_object($messages) && $messages->count() > 0)
	<div class="alert alert-{{ $type }} alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ implode('<br>', $messages->all()) }}
	</div>
@endif