<x-app-layout>
  <x-nav-bar/>
  <x-side-bar/>
  <div class="wrapper">
    <!-- Main Content -->
    <div id="main">

        <div class="row justify-content-center">
          <div class="col-auto py-4">
            <h2 class="h2 me-auto">Barang Jadi</h2>
          </div>
        </div>
        
        <div class="row justify-content-center">
          <div class="col-8">
            <form method="POST" action="{{ route('barang-jadi.update', $barangJadi->id) }}">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label for="id_barang_jadi" class="form-label">ID</label>
                <input readonly type="text" class="form-control bg-white" name="id_barang_jadi" id="id_barang_jadi" value="{{ $barangJadi->id }}">
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input  type="text" class="form-control bg-white" name="nama" id="nama" value="{{ old('nama', $barangJadi->nama) }}">
                @error('nama')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input readonly type="text" class="form-control bg-white" name="kategori" id="kategori" value="{{ $barangJadi->kategoriPerabot->nama }}">
              </div>
              <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea  rows="5" name="deskripsi" id="deskripsi" class="form-control bg-white" type="text">{{ old('deskripsi', $barangJadi->deskripsi) }}</textarea>
                @error('deskripsi')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input  name="jumlah" id="jumlah" class="form-control bg-white" value="{{ old('jumlah', $barangJadi->jumlah) }}" type="number">
                @error('jumlah')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="harga_minimal" class="form-label">Harga Min. / Satuan</label>
                <input  name="harga_minimal" readonly id="harga_minimal" class="form-control bg-white" value="{{ Number::currency($barangJadi->harga_minimal, 'IDR', 'id') }}" type="text">
              </div>
              <br>
              <br>
              <div class="mb-3">
                <input type="submit" name="submit" id="submit" value="Simpan" class="btn btn-info text-white">
                <a href="{{ route('barang-jadi.index') }}" class="btn btn-secondary" style="width:95px;">Batal</a>
              </div>
              
            </form>
          </div>
        </div>
  

    </div>
  </div>
  
</x-app-layout>