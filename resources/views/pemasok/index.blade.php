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
                <h1 class="h2 me-auto">Pemasok</h1>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">

              <!-- Form Pencarian -->
              <div class="py-4 d-flex justify-content-between align-items-center">
                <a href="{{ route('pemasok.create') }}" class="btn btn-primary">Tambah</a>

                <form class="w-50 ms-4" method="get">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Pemasok">
                    <input type="submit" class="btn btn-outline-secondary" value="Cari">
                  </div>
                </form>
              </div>

              <!-- Tabel Pemasok -->
        
              <table class="table table-striped align-middle mt-3">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>No Telepon</th>
                  <th>Alamat</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($pemasoks as $pemasok)
                    <tr>
                    <td>{{ $pemasok->id }}</td>
                    <td>{{ $pemasok->nama }}</td>
                    <td>{{ $pemasok->no_telepon }}</td>
                    <td>{{ $pemasok->alamat }}</td>
                    <td>
                      <a href="{{ route('pemasok.show', ['id' => $pemasok->id]) }}" class="btn btn-info btn-sm text-white">Lihat</a>
                      <a href="{{ route('pemasok.edit', ['id' => $pemasok->id ]) }}" class="btn btn-secondary btn-sm text-white">Edit</a>
                      <a href="{{ route('pemasok.destroy', ['id' => $pemasok->id]) }}" class="btn btn-danger btn-sm alert_notif">Hapus</a>
                    </td>
                    </tr>
                  
                  @endforeach
              </tbody>
              </table>

              {{ $pemasoks->links() }}
            </div>
          </div>

        </div>
    
    </div>
</x-app-layout>
