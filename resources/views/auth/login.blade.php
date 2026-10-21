<x-app-layout>
    <x-nav-bar>
        <a class="navbar-link p-3 text-black text-decoration-none" href="#">
			<img src="{{ asset('images/chair1.png') }}" width="24" height="24" class="d-inline-block">Surian Mas
		</a>
		<a class="nav-link p-3 text-black {{ request()->routeIs('tentang-kami') ? 'active' : '' }}" href="#">Tentang Kami</a>

		<div class="navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ms-auto">
				<li class="nav-item ">
					<a class="nav-link p-3 text-black {{ request()->routeIs('login') ? 'active' : '' }}" href="#" id="navbarScrollingDropdown" role="button">
					Login</a>
				</li>
			</ul>
		</div>
    </x-nav-bar>
    <x-side-bar/>

</x-app-layout>