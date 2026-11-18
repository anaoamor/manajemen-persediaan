<!--NAVBAR-->
<nav id="main-navbar" class="navbar navbar-expand-md navbar-light sticky-top py-0">
	<div class="container">
		<a class="navbar-brand" href="{{ route('pemasok.index') }}">
			<img src="{{ asset('/images/chair1.png') }}" width="24" height="24" class="d-inline-block">Surian Mas
		</a>
		<a class="nav-link p-3 text-black {{ request()->routeIs('tentang-kami') ? 'active' : '' }}" href="{{ route('tentang-kami') }}">Tentang Kami</a>

		<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
						<li class="nav-item">
								<a class="nav-link p-3 text-black submenu {{ request()->routeIs('login') ? 'active' : '' }}" href="@if (Auth::user() == null) {{ route('login') }}
                @else 
                  {{route('logout')}}  
                @endif" id="navbarScrollingDropdown" role="button">
								@if (Auth::user() == null)
                  Login
                @else
                  Logout
                @endif</a>
						</li>
				</ul>
		</div>

	</div>
</nav>