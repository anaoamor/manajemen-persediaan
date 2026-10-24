<!--Sidebar-->
<nav id="sidebar">

    <ul class="list-unstyled components">
        <li class="{{ request()->routeIs('pemasok.*') ? 'active' : '' }}">
          <a href="{{ route('pemasok.index') }}">Pemasok</a>
        </li>
        <li class="{{ request()->routeIs('barang-mentah.*') ? 'active' : '' }}">
            <a href="{{ route('barang-mentah.index') }}">Barang Mentah</a>
        </li>
        <li class="{{ request()->routeIs('pembuatan.*') ? 'actie' : '' }}">
            <a href="{{ route('pembuatan.index') }}">Buat</a>
        </li>
        <li class="{{ request()->routeIs('barang-jadi.*') ? 'active' : ''}}">
            <a href="{{ route('barang-jadi.index') }}">Barang Jadi</a>
        </li>
        <li class="{{ request()->routeIs('penjualan.*') ? 'active' : '' }}">
            <a href="{{ route('penjualan.index') }}">Penjualan</a>
        </li>
        <li>
            <a href="#">Keuangan</a>
        </li>
    </ul>
</nav>
