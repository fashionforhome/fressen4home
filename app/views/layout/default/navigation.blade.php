<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
        <div class="navbar-header pull-left">
            <button type="button" class="pull-left btn btn-default navbar-btn visible-xs visible-sm">
                <a href="{{{ URL::previous() }}}"><span class="glyphicon glyphicon-arrow-left"></span></a>
            </button>
            <a class="navbar-brand" href="#">{{ Config::get('app.project_name') }}</a>
        </div>
		<div class="navbar-header pull-right">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
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
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ URL::route('user.deliveries') }}">My Deliveries</a></li>
                            <li><a href="{{ URL::route('user.orders') }}">My Orders</a></li>
                        </ul>
                    </li>
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