<div class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">{{ Config::get('app.project_name') }}</a>
		</div>
		<div class="navbar-collapse collapse">

			@if (Auth::check())
				<?php $navigation = Config::get('navigation.user'); ?>
			@else
				<?php $navigation = Config::get('navigation.guest'); ?>
			@endif

			@if (isset($navigation['left']) && count($navigation['left']) > 0)
				<ul class="nav navbar-nav">
					@foreach ($navigation['left'] as $routeName => $routeData)
						<li @if (Route::currentRouteName() === $routeName || isset($routeData['also']) && in_array(Route::currentRouteName(), $routeData['also'])) class="active" @endif>
							<a href="{{ URL::route($routeName) }}">{{ $routeData['label'] }}</a>
						</li>
					@endforeach
				</ul>
			@endif

			@if (isset($navigation['right']) && count($navigation['right']) > 0)
				<ul class="nav navbar-nav navbar-right">
					@foreach ($navigation['right'] as $routeName => $routeData)
						<li @if (Route::currentRouteName() === $routeName || isset($routeData['also']) && in_array(Route::currentRouteName(), $routeData['also'])) class="active" @endif>
							<a href="{{ URL::route($routeName) }}">{{ $routeData['label'] }}</a>
						</li>
					@endforeach
				</ul>
			@endif

		</div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
</div>