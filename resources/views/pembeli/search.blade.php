<x-app-layout>
  <x-nav-bar/>
  <x-side-bar/>

  <div class="wrapper">
    <!-- Main Content -->
        <div id="main">
          <div class="row">
            <div class="row justify-content-center">
              <div class="col-auto py-4">
                <h1 class="h2 me-auto">Pembeli</h1>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">

              <!-- Form Pencarian -->
              <div class="py-4 d-flex justify-content-between align-items-center">
                <a href="{{ route('pembeli.create') }}" class="btn btn-primary">Tambah</a>

                <form class="w-50 ms-4" method="get" action="{{ route('pembeli.search') }}">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Pembeli" value="{{ $searchTerm }}">
                    <input type="submit" class="btn btn-outline-secondary" value="Cari">
                  </div>
                </form>
              </div>

              <!-- Tabel Pembeli -->
        
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
                  @forelse($pembelis as $pembeli)
                    <tr>
                    <td>{{ $pembeli->id }}</td>
                    <td>{{ $pembeli->nama }}</td>
                    <td>{{ $pembeli->no_telepon }}</td>
                    <td>{{ $pembeli->alamat }}</td>
                    <td>
                      <form action="{{ route('pembeli.destroy', $pembeli->id) }}" class="delete-form" method="GET">
                        @csrf
                        <a href="{{ route('pembeli.show', ['id' => $pembeli->id]) }}" class="btn btn-info btn-sm text-white">Lihat</a>
                        <a href="{{ route('pembeli.edit', ['id' => $pembeli->id ]) }}" class="btn btn-secondary btn-sm text-white">Edit</a>
                        <button type="submit"  class="btn btn-danger btn-sm">Hapus</button>
                      </form>
                    </td>
                    </tr>
                    @empty
                    <p>Tidak ditemukan hasil</p>
                  @endforelse
                  
              </tbody>
              </table>

              {{ $pembelis->links() }}
            </div>
          </div>

        </div>
  </div>

</x-app-layout>
@session('success')
  <script>
    Swal.fire({
      title: 'Sukses',
      text: 'Pembeli berhasil dihapus',
      icon: 'success',
      timer: 3000,
      showConfirmButton:false,
    });
  </script>
@endsession
<script>
  $('.delete-form').on('submit', function(){
    event.preventDefault();

    var getLink = $(this).attr('action');
    Swal.fire({
      title: "Yakin menghapus pembeli?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonColor: '#3085d6',
      cancelButtonText: 'Batal',
    }).then(result => {
        if(result.isConfirmed){
          window.location.href = getLink;
        }
      
    });
    return false;
  });
</script>