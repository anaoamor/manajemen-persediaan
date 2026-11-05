<x-app-layout>
  <x-nav-bar/>
  <x-side-bar/>

  <div class="wrapper">
    <!-- Main Content -->
        <div id="main">
          <div class="row">
            <div class="row justify-content-center">
              <div class="col-auto py-4">
                <h1 class="h2 me-auto">Buat</h1>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">

              <!-- Form Pencarian -->
              <div class="py-4 d-flex justify-content-between align-items-center">
                <a href="{{ route('pembuatan.create') }}" class="btn btn-primary">Tambah</a>

                <form class="w-50 ms-4" method="get" action="#">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Barang Jadi">
                    <input type="submit" name="search-submit" class="btn btn-outline-secondary" value="Cari">
                  </div>
                </form>
              </div>

              <!-- Tabel Pembuatan -->
        
              <table class="table table-striped align-middle mt-3">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Jumlah</th>
                  <th>Waktu</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($pembuatans as $pembuatan)
                    <tr>
                    <td>{{ $pembuatan->id }}</td>
                    <td>{{ $pembuatan->barangJadi->nama }}</td>
                    <td>{{ $pembuatan->barangJadi->jumlah }}</td>
                    <td>{{ \Carbon\Carbon::parse($pembuatan->waktu)->isoFormat('dddd, D MMMM YYYY hh:mm') }}</td>
                    <td>{{ $pembuatan->status }}</td>
                    <td>
                      <form method="GET" class="delete-form" action="{{ route('pembuatan.destroy', $pembuatan->id) }}">
                        @csrf
                        <a href="{{ route('pembuatan.show', ['id' => $pembuatan->id]) }}" class="btn btn-info btn-sm text-white">Lihat</a>
                        <a href="{{ route('pembuatan.edit', ['id' => $pembuatan->id ]) }}" class="btn btn-secondary btn-sm text-white">Edit</a>
                        <a href="#" class="btn btn-success btn-sm">Selesai</a>
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                      </form>
                      
                    </td>
                    </tr>
                  
                  @endforeach
              </tbody>
              </table>

              {{ $pembuatans->links() }}
            </div>
          </div>

        </div>
  </div>

</x-app-layout>