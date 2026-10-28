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
                <h1 class="h2 me-auto">Kategori</h1>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">

              <div class="py-4 d-flex justify-content-left align-items-center">
                <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah</a>

              </div>

              <!-- Tabel Kategori -->
        
              <table class="table table-striped align-middle mt-3 mx-3">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($kategoris as $kategori)
                    <tr>
                      <td>{{ $kategori->id }}</td>
                      <td>{{ $kategori->nama }}</td>                    
                    </tr>
                  @endforeach
                  
              </tbody>
              </table>

              {{ $kategoris->links() }}
            </div>
          </div>

        </div>
    
    </div>
</x-app-layout>