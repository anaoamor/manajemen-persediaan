<x-app-layout>
    <x-nav-bar>
        <a class="navbar-brand" href="#">
				<img src="{{ asset('/images/chair1.png') }}" width="24" height="24" class="d-inline-block">Surian Mas
        </a>
        <a class="nav-link p-3 text-black {{ request()->routeIs('tentang-kami') ? 'active' : '' }}" href="#">Tentang Kami</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link p-3 text-black {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}" id="navbarScrollingDropdown" role="button">
                    Logout</a>
                </li>
            </ul>
        </div>

    </x-nav-bar>
    <x-side-bar/>

    <div class="wrapper">

    </div>
</x-app-layout>
