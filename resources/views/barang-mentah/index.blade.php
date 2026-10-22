<x-app-layout>
    <x-nav-bar>
    </x-nav-bar>

    <x-side-bar />

    <div class="wrapper">

        <!-- Main Content -->
        <div id="main">
          <div class="row">
            <div class="row justify-content-center">
              <div class="col-auto py-4">
                <h1 class="h2 me-auto">Barang Mentah</h1>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">

              <!-- Form Pencarian -->
              <div class="py-4 d-flex justify-content-between align-items-center">
                <a href="{{ route('barang-mentah.create') }}" class="btn btn-primary">Tambah</a>

                <form class="w-50 ms-4" method="get">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Barang Mentah">
                    <input type="submit" class="btn btn-outline-secondary" value="Cari">
                  </div>
                </form>
              </div>

              <!-- Tabel Barang Mentah -->
        
              <table class="table table-striped align-middle mt-3">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Kategori</th>
                  <th>Satuan Hitung</th>
                  <th>Ukuran</th>
                  <th>Stok</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($barangMentahs as $barangMentah)
                    <tr>
                    <td>{{ $barangMentah->id }}</td>
                    <td>{{ $barangMentah->nama }}</td>
                    <td>{{ $barangMentah->kategori }}</td>
                    <td>{{ $barangMentah->satuan_hitung }}</td>
                    <td>{{ $barangMentah->ukuran }}</td>
                    <td>{{ $barangMentah->stok }}</td>
                    <td>
                      <a href="{{ route('barang-mentah.show', ['id' => $barangMentah->id]) }}" class="btn btn-info btn-sm text-white">Lihat</a>
                      <a href="{{ route('barang-mentah.edit', ['id' => $barangMentah->id ]) }}" class="btn btn-secondary btn-sm text-white">Edit</a>
                      <a href="{{ route('barang-mentah.destroy', ['id' => $barangMentah->id]) }}" class="btn btn-danger btn-sm alert_notif">Hapus</a>
                    </td>
                    </tr>
                  
                  @endforeach
              </tbody>
              </table>

              {{ $barangMentahs->links() }}
            </div>
          </div>

        </div>
    
    </div>
</x-app-layout>
