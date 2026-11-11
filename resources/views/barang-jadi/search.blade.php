<x-app-layout>
  <x-nav-bar/>
  <x-side-bar/>

  <div class="wrapper">
    <!-- Main Content -->
      <div id="main">
        <div class="row">
          <div class="row justify-content-center">
            <div class="col-auto py-4">
              <h1 class="h2 me-auto">Barang Jadi</h1>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">

            <!-- Form Pencarian -->
            <div class="py-4 d-flex justify-content-end align-items-center">
              
              <form class="w-50 ms-4" method="get" action="{{ route('barang-jadi.search') }}">
                <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Barang Jadi" value="{{ $searchTerm }}">
                  <input type="submit" name="search-submit" class="btn btn-outline-secondary" value="Cari">
                </div>
              </form>
            </div>

            <!-- Tabel Barang Jadi -->
      
            <table class="table table-striped align-middle mt-3">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga Min. / Satuan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @forelse($barangJadis as $barangJadi)
                  <tr>
                  <td>{{ $barangJadi->id }}</td>
                  <td>{{ $barangJadi->nama }}</td>
                  <td>{{ $barangJadi->kategoriPerabot->nama }}</td>
                  <td>{{ $barangJadi->jumlah }}</td>
                  <td>{{ Number::currency($barangJadi->harga_minimal, 'IDR', 'id') }}</td>
                  <td>
                      <a href="{{ route('barang-jadi.show', ['id' => $barangJadi->id]) }}" class="btn btn-info btn-sm text-white">Lihat</a>
                      <a href="{{ route('barang-jadi.edit', ['id' => $barangJadi->id]) }}" class="btn btn-secondary btn-sm text-white">Edit</a>
                    
                  </td>
                  </tr>
                
                  @empty
                    <p>Tidak ditemukan hasil</p>
                @endforelse
            </tbody>
            </table>

            {{ $barangJadis->links() }}
          </div>
        </div>

      </div>
  </div>

</x-app-layout>