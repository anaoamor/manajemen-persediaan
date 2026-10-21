<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="{{ asset('chair1.png') }}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{  asset('css/style.css') }}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
	<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<title>{{ config('app.name') }}</title>
	
</head>
<body>

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