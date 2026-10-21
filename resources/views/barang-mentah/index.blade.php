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

    <x-side-bar />

    <div class="wrapper">

        <!-- Main Content -->
        <div id="main">

            <div class="row">
                <div class="col-12">

                <!-- Form Pencarian -->
                <div class="py-4 d-flex justify-content-between align-items-center">
                    <a href="tambah_bibit.php" class="btn btn-primary">Tambah</a>

                    <form class="w-50 ms-4" method="get">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Nama Bibit">
                        <input type="submit" class="btn btn-outline-secondary" value="Cari">
                    </div>
                    </form>
                </div>

                <!-- Tabel Bibit Tanaman -->
            
                    <table class="table table-striped align-middle mt-3">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Harga (Rp)</th>
                        <th>Stok</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <?php
                        // foreach($tabelBibit as $bibit){
                        //     echo "<tr>";
                        //     echo "<td> {$bibit->id_bibit_tanaman}</td>";
                        //     echo "<td><div class=\"img-box\"><img src=\"../{$bibit->gambar}\" class=\"img-fluid\"></div></td>";
                        //     echo "<td>{$bibit->nama}</td>";
                        //     echo "<td>".number_format($bibit->harga,0,',','.')."</td>";
                        //     echo "<td>{$bibit->stok}</td>";
                        //     echo "<td>";
                        //     echo "<a href=\"tampil_bibit.php?id_bibit_tanaman={$bibit->id_bibit_tanaman}\" class=\"btn btn-info btn-sm text-white\">Tampil</a> ";
                        //     echo "<a href=\"edit_bibit.php?id_bibit_tanaman={$bibit->id_bibit_tanaman}\" class=\"btn btn-secondary btn-sm text-white\">Edit</a> ";
                        //     echo "<a href=\"hapus_bibit.php?id_bibit_tanaman={$bibit->id_bibit_tanaman}\" class=\"btn btn-danger btn-sm alert_notif\">Hapus</a>";
                        //     echo "</td>";
                        //     echo "</tr>";
                        // }
                        ?> --}}
                    </tbody>
                    </table>

                </div>
            </div>

        </div>
    
    </div>
</x-app-layout>
