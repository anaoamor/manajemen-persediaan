<x-app-layout>
  <x-nav-bar/>
  <x-side-bar/>

  <div class="wrapper">
    <!-- Main Content -->
    <div id="main">
      <div class="row">
        <div class="row justify-content-center">
          <div class="col-auto py-4">
            <h1 class="h2 me-auto">Penjualan</h1>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">

          <!-- Form Pencarian -->
          <div class="py-4 d-flex justify-content-between align-items-center">
            <a href="{{ route('penjualan.create') }}" class="btn btn-primary">Tambah</a>

            <form class="w-50 ms-4" method="get" action="{{ route('penjualan.search') }}">
              <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Barang Jadi">
                <input type="submit" name="search-submit" class="btn btn-outline-secondary" value="Cari">
              </div>
            </form>
          </div>

          <!-- Tabel penjualan -->
    
          <table class="table table-striped align-middle mt-3">
          <thead>
            <tr>
              <th>ID</th>
              <th>Waktu</th>
              <th>Item</th>
              <th>Pelanggan</th>
              <th>Alamat</th>
              <th>Total Pembayaran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach($penjualans as $penjualan)
                <tr>
                <td>{{ $penjualan->id }}</td>
                <td>{{ \Carbon\Carbon::parse($penjualan->waktu)->isoFormat('dddd, DD MMMM YYYY HH:mm') }}</td>
                <td>
                  <ul class="list-unstyled">
                    @foreach($penjualan->barangDijual as $item) 
                    <li>{{ $item->barangJadi->nama }}</li>   
                    @endforeach
                  </ul>
                </td>
                <td>{{ $penjualan->pembeli->nama }}</td>
                <td>{{ $penjualan->pembeli->alamat }}</td>
                <td>{{ Number::currency($penjualan->total_pembayaran, 'IDR', 'id') }}</td>
                <td>
                  <form method="GET" class="delete-form" action="{{ route('penjualan.destroy', $penjualan->id) }}">
                    @csrf
                    <a href="{{ route('penjualan.show', ['id' => $penjualan->id]) }}" class="btn btn-info btn-sm text-white">Lihat</a>
                    <a href="{{ route('penjualan.edit', ['id' => $penjualan->id ]) }}" class="btn btn-secondary btn-sm text-white">Edit</a>
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                  </form>
                  
                </td>
                </tr>
              
              @endforeach
          </tbody>
          </table>

          {{ $penjualans->links() }}
        </div>
      </div>

    </div>
  </div>

</x-app-layout>