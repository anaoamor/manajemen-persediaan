<x-app-layout>
  <x-nav-bar/>
  <x-side-bar/>

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

                <form class="w-50 ms-4" method="get" action="{{ route('barang-mentah.search') }}">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Barang Mentah" value="{{ $searchTerm }}">
                    <input type="submit" name="search-submit" class="btn btn-outline-secondary" value="Cari">
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
                  @forelse($barangMentahs as $barangMentah)
                    <tr>
                    <td>{{ $barangMentah->id }}</td>
                    <td>{{ $barangMentah->nama }}</td>
                    <td>{{ $barangMentah->kategori->nama }}</td>
                    <td>{{ $barangMentah->satuan_hitung }}</td>
                    <td>{{ $barangMentah->ukuran }}</td>
                    <td>{{ $barangMentah->stok }}</td>
                    <td>
                      <form method="GET" class="delete-form" action="{{ route('barang-mentah.destroy', $barangMentah->id) }}">
                        @csrf
                        <a href="{{ route('barang-mentah.show', ['id' => $barangMentah->id]) }}" class="btn btn-info btn-sm text-white">Lihat</a>
                        <a href="{{ route('barang-mentah.edit', ['id' => $barangMentah->id ]) }}" class="btn btn-secondary btn-sm text-white">Edit</a>
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                      </form>
                      
                    </td>
                    </tr>
                  @empty
                    <p>Tidak ditemukan hasil</p>
                  @endforelse
              </tbody>
              </table>

              {{ $barangMentahs->links() }}
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
      text: 'Barang mentah berhasil dihapus',
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
      title: "Yakin menghapus barang mentah?",
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