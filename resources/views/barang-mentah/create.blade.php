<x-app-layout>
  <x-nav-bar/>
  <x-side-bar/>
  <div class="wrapper">
    <!-- Main Content -->
    <div id="main">

        <div class="row justify-content-center">
          <div class="col-auto py-4">
            <h2 class="h2 me-auto">Barang Mentah</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-8">
            <!-- Form untuk proses insert -->
            <form method="post" action="{{ route('barang-mentah.store') }}">
              @csrf
              <div class="mb-3">
                <label for="kode_item" class="form-label">Kode Item</label>
                <input type="text" class="form-control" name="kode_item" id="kode_item" value="">
                @error('kode_item')
                  <small class="text-danger pesan-error">{{ $message }}</small>  
                @enderror
              </div>
              <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama</label>
                <input name="nama_barang" id="nama_barang" class="form-control" value="{{ old('kode_item') }}" type="text">
                @error('nama_barang')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" name="kategori" id="kategori" value="{{ old('kategori') }}">
                @error('kategori')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror  
              </div>
              <div class="mb-3">
                <label for="satuan_hitung" class="form-label">Satuan Hitung</label>
                <input type="text" class="form-control" name="satuan_hitung" id="satuan_hitung" value="{{ old('satuan_hitung') }}">
                @error('satuan_hitung')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="text" class="form-control" name="stok" id="stok" value="{{ old('stok') }}">
                @error('stok')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="ukuran" class="form-label">Ukuran</label>
                <input name="ukuran" id="ukuran" type="text" class="form-control" value="{{ old('ukuran') }}">
                @error('ukuran')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="supplier" class="form-label">Supplier</label>
                <input type="text" class="form-control" name="supplier" id="supplier" value="{{ old('supplier') }}">
                @error('supplier')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="harga_per_satuan" class="form-label">Harga Per Satuan</label>
                <input type="text" class="form-control" name="harga_persatuan" id="harga_persatuan" value="{{ old('harga_per_satuan') }}">
                @error('harga_per_satuan')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
              <br>
              <br>
              <div class="mb-3">
                <input type="submit" value="Simpan" class="btn btn-info text-white" name="submit">
                <a id="btn-cancel" class='btn btn-secondary' style="width: 95px;">Batal</a>
              </div>
              
            </form>
          </div>
        </div>
  

    </div>
  </div>
</x-app-layout>