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
                <input type="text" class="form-control" name="kode_item" id="kode_item" value="{{ old('kode_item') }}">
                @error('kode_item')
                  <small class="text-danger pesan-error">{{ $message }}</small>  
                @enderror
              </div>
              <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama</label>
                <input name="nama_barang" id="nama_barang" class="form-control" value="{{ old('nama_barang') }}" type="text">
                @error('nama_barang')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="id_kategori" class="form-label">Kategori</label>
                <select class="form-select" id="id_kategori" name="id_kategori" aria-label="Kategori">
                  <option>Pilih kategori</option>
                  @foreach ($kategoris as $kategori)
                    <option @selected(old('id_kategori') == $kategori->id) value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                  @endforeach
                </select>
                @error('id_kategori')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror  
              </div>
              <div class="mb-3">
                <label for="satuan_hitung" class="form-label">Satuan Hitung</label>
                <select class="form-select" name="satuan_hitung" id="satuan_hitung" aria-label="Satuan Hitung">
                  <option>Pilih satuan hitung</option>
                  <option value="Batang" @selected(old('satuan_hitung') == "Batang")>Batang</option>
                  <option value="Lembar" @selected(old('satuan_hitung') == "Lembar")>Lembar</option>
                  <option value="Kaleng" @selected(old('satuan_hitung') == "Kaleng")>Kaleng</option>
                  <option value="Buah" @selected(old('satuan_hitung') == "Buah")>Buah</option>
                  <option value="Kg" @selected(old('satuan_hitung') == "Kg")>Kg</option>
                </select>
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
                <label for="harga_per_satuan" class="form-label">Harga Per Satuan</label>
                <input type="text" class="form-control" name="harga_per_satuan" id="harga_per_satuan" value="{{ old('harga_per_satuan') }}" placeholder="Rp 30.000">
                @error('harga_per_satuan')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
              <fieldset class="border rounded-3 p-3">
                <legend class="float-none w-auto px-3">Pemasok</legend>
                <div class="mb-3">
                  <label for="id_supplier">Pemasok</label>
                  <select class="form-select" name="id_supplier" id="id_supplier" aria-label="Pemasok">
                    <option>Pilih pemasok yang tersedia</option>
                    @foreach ($pemasoks as $pemasok)
                      <option @selected(old('id_supplier') == $pemasok->id) value="{{ $pemasok->id }}" data-id="{{ $pemasok->id }}" data-nama="{{ $pemasok->nama }}" data-no_telepon="{{ $pemasok->no_telepon }}" data-alamat="{{ $pemasok->alamat }}">
                        {{ $pemasok->nama }}
                      </option>
                    @endforeach
                  </select>
                  @error('id_supplier')
                    <small class="text-danger pesan-error">{{ $message }}</small>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="no_telepon" class="form-label">No Telepon</label>
                  <input readonly type="text" class="form-control bg-white" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}">
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <textarea readonly name="alamat" id="alamat" class="form-control bg-white" rows="5">{{ old('alamat') }}</textarea>
                </div>
              </fieldset>
              <br>
              <br>
              <div class="mb-3">
                <input type="submit" value="Simpan" class="btn btn-info text-white" name="submit">
                <a id="btn-cancel" href="{{ route('barang-mentah.index') }}" class='btn btn-secondary' style="width: 95px;">Batal</a>
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
    document.getElementById('no_telepon').value = idPemasok.dataset.no_telepon ?? '';
    document.getElementById('alamat').value = idPemasok.dataset.alamat ?? '';

    if(!idPemasok | !this.value){
      document.getElementById('no_telepon').value = '';
      document.getElementById('alamat').value = '';
      return;
    }

  })
</script>