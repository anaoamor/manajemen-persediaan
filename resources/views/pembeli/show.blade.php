<x-app-layout>
  <x-nav-bar/>
  <x-side-bar/>

  <div class="wrapper">
    <!-- Main Content -->
    <div id="main">

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-auto py-4">
            <h1 class="h4 me-auto">Pembeli</h1>
          </div>
        </div>
      
        <div class="row justify-content-center">
          <div class="col-8">

            <div class="mb-3">
              <label for="id" class="form-label">ID</label>
              <input  type="text" name="id_pembeli" id="id_pembeli" class="form-control bg-white" value="{{ $pembeli->id }}" readonly>
            </div>

            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input readonly name="nama" id="nama" class="form-control bg-white" value="{{ $pembeli->nama }}">
            </div>

            <div class="mb-3">
              <label for="no_telepon" class="form-label">No Telepon</label>
              <input readonly type="text" class="form-control bg-white" name="no_telepon" id="no_telepon" value="{{ $pembeli->no_telepon }}">
            </div>

            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <input readonly type="text" class="form-control bg-white" name="alamat" id="alamat" value="{{ $pembeli->alamat }}">
            </div>

            
            <br>
            <br>
            <div class="mb-3">
              <a href="{{ route('pembeli.index') }}" class="btn btn-info text-white" style="width: 95px;">OK</a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</x-app-layout>