<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="{{ asset('chair1.png') }}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
	<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<title>{{ config('app.name') }}</title>
	
</head>
<body>
		
	<!--NAVBAR-->
	<nav id="main-navbar" class="navbar navbar-expand-md navbar-light sticky-top py-0">
		<div class="container">
			<a class="navbar-link p-3 text-black text-decoration-none" href="#">
				<img src="images/chair1.png" width="24" height="24" class="d-inline-block">Surian Mas
			</a>
			<a class="nav-link p-3 text-black <?php echo basename($_SERVER['PHP_SELF']) == "tentang_kami.php" ? "active" : ""; ?>" href="#">Tentang Kami</a>

			<div class="navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item ">
						<a class="nav-link p-3 text-black <?php echo basename($_SERVER['PHP_SELF']) == 'profil_petani.php' ? 'active' : ''; ?>" href="#" id="navbarScrollingDropdown" role="button">
						Login</a>
					</li>
				</ul>
			</div>

		</div>
	</nav>

	<div class="wrapper">

		<!--Sidebar-->
		<nav id="sidebar">

			<ul class="list-unstyled components">
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

    </div>

    {{ $slot }}

    <!-- FOOTER -->
    <footer id="main-footer" class="py-4">
    <div class="container">
    <div class="row">
        <div class="col-12">
        <small>
        <?php 
            $tanggal = new DateTime('now');
            echo "<p class=\"text-center\">Copyright © ".$tanggal->format("Y")." Surian Mas</p>";
        ?>
        </small>
        </div>
    </div>
    </div>
    </footer>

    <script src="../js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>

</body>
</html>