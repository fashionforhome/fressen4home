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
				<ul class="nav navbar-nav">
                    <li class="active"><a href="{{ URL::route('deliveries.active') }}">Active Deliveries</a></li>
					<li class="active"><a href="{{ URL::route('stores.all') }}">Stores</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{ URL::route('user.logout') }}">Logout</a></li>
				</ul>
			@else
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{ URL::route('user.login.form') }}">Login</a></li>
					<li><a href="{{ URL::route('user.register.form') }}">Register</a></li>
				</ul>
			@endif
		</div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
</div>