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

                <form class="w-50 ms-4" method="get" action="{{ route('pemasok.search') }}">
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
                  <th>Aksi</th>
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
                      <form action="{{ route('pemasok.destroy', $pemasok->id) }}" class="delete-form" method="GET">
                        @csrf
                        <a href="{{ route('pemasok.show', ['id' => $pemasok->id]) }}" class="btn btn-info btn-sm text-white">Lihat</a>
                        <a href="{{ route('pemasok.edit', ['id' => $pemasok->id ]) }}" class="btn btn-secondary btn-sm text-white">Edit</a>
                        <button type="submit"  class="btn btn-danger btn-sm">Hapus</button>
                      </form>
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
@if (session('success'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Sukses',
      text: 'Pemasok berhasil dihapus',
      timer: 3000,
      showConfirmButton: false
    })
  </script>

@endif()
<script>
  $('.delete-form').on('submit', function(){
    event.preventDefault();
    
    var getLink = $(this).attr('action');
    Swal.fire({
      title: "Yakin menghapus pemasok?",
      icon : 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonColor: '#3085d6',
      cancelButtonText: "Batal"
    }).then(result => {
      if(result.isConfirmed){
        window.location.href = getLink
      }
    })
    return false;
  });
</script>