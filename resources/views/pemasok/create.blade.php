<x-app-layout>
  <x-nav-bar/>
  <x-side-bar/>
  <div class="wrapper">
    <!-- Main Content -->
    <div id="main">

        <div class="row justify-content-center">
          <div class="col-auto py-4">
            <h2 class="h2 me-auto">Pemasok</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-8">
            <!-- Form untuk proses insert -->
            <form method="post" action="{{ route('pemasok.store') }}">
              @csrf
              <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}">
                @error('nama')
                  <small class="text-danger pesan-error">{{ $message }}</small>  
                @enderror
              </div>
              <div class="mb-3">
                <label for="no_telepon" class="form-label">No Telepon</label>
                <input name="no_telepon" id="no_telepon" class="form-control" value="{{ old('no_telepon') }}" type="text">
                @error('no_telepon')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat" value="{{ old('alamat') }}">
                @error('alamat')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror  
              </div>
              <br>
              <br>
              <div class="mb-3">
                <input type="submit" value="Simpan" class="btn btn-info text-white" name="submit">
                <a id="btn-cancel" href="{{ route('pemasok.index') }}" class='btn btn-secondary' style="width: 95px;">Batal</a>
              </div>
              
            </form>
          </div>
        </div>
  

    </div>
  </div>
  
</x-app-layout>
<script>
  document.getElementById('id_supplier').addEventListener('change', function(){
    const idPemasok = this.selectedOptions[0];
    document.getElementById('nama_supplier').value = idPemasok.dataset.nama ?? '';
    document.getElementById('no_telepon').value = idPemasok.dataset.no_telepon ?? '';
    document.getElementById('alamat').value = idPemasok.dataset.alamat ?? '';

    if(!idPemasok | !this.value){
      document.getElementById('nama_supplier').value = '';
      document.getElementById('no_telepon').value = '';
      document.getElementById('alamat').value = '';
      return;
    }

  })
</script>