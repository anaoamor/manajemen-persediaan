<x-app-layout>
  <x-nav-bar/>
  <x-side-bar/>

  <div class="wrapper">
    <!-- Main Content -->
    <div id="main">

        <div class="row justify-content-center">
          <div class="col-auto py-4">
            <h2 class="h2 me-auto">Buat</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-8">
            <!-- Form untuk proses insert -->
            <form method="post" action="{{ route('pembuatan.store') }}">
              @csrf
              <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}">
                @error('nama_barang')
                  <small class="text-danger pesan-error">{{ $message }}</small>  
                @enderror
              </div>
              <div class="mb-3">
                <label for="id_kategori" class="form-label">Kategori</label>
                <select name="id_kategori" id="id_kategori" class="form-select" aria-label="Kategori">
                  <option>Pilih kategori</option>
                  @foreach ($kategoris as $kategori)
                    <option @selected(old('id_kategori') == $kategori->id) value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                  @endforeach
                </select>
                @error('id_kategori')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
              <fieldset class="border rounded-3 p-3" id="barang-mentah-fs">
                <legend class="float-none w-auto px-3">Barang Mentah</legend>
                <div class="barang-mentah-container" id="barang-mentah-container">
                  <div class="mb-3 row">
                    <div class="col">
                      <label for="id_barang_mentah" class="form-label">Barang Mentah 1</label>
                      <select class="form-select" name="id_barang_mentah[]" id="id_barang_mentah" aria-label="Barang Mentah">
                        <option>Pilih barang mentah</option>
                        @foreach ($barangMentahs as $barangMentah)
                          <option @selected(old('id_barang_mentah') == $barangMentah->id) value="{{ $barangMentah->id }}">
                            {{ $barangMentah->nama }}
                          </option>
                        @endforeach
                      </select>
                      @error('id_barang_mentah')
                        <small class="text-danger pesan-error">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="col">
                      <label for="jumlah_barang_mentah" class="form-label">Jumlah</label>
                      <input type="number" name="jumlah_barang_mentah[]" id="jumlah_barang_mentah" class="form-control" value="{{ old('jumlah_barang_mentah') }}">
                    </div>
                    @error('jumlah_barang_mentah')
                      <small class="text-danger pesan-error">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
                
                <div class="row">
                  <button id="tambah-btn" class="btn btn-info text-white btn-sm" style="width:95px;">Tambah</button>
                </div>
              </fieldset>
              <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah') }}">
                @error('jumlah')
                  <small class="text-danger pesan-error">{{ $message }}</small>
                @enderror
              </div>
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
  const barangMentahContainer = document.getElementById('barang-mentah-container');
  const tambahBtn = document.getElementById('tambah-btn');
  const indexBarangMentah = 2;

  <div class="mb-3 row">
                    <div class="col">
                      <label for="id_barang_mentah" class="form-label">Barang Mentah 1</label>
                      <select class="form-select" name="id_barang_mentah[]" id="id_barang_mentah" aria-label="Barang Mentah">
                        <option>Pilih barang mentah</option>
                        @foreach ($barangMentahs as $barangMentah)
                          <option @selected(old('id_barang_mentah') == $barangMentah->id) value="{{ $barangMentah->id }}">
                            {{ $barangMentah->nama }}
                          </option>
                        @endforeach
                      </select>
                      @error('id_barang_mentah')
                        <small class="text-danger pesan-error">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="col">
                      <label for="jumlah_barang_mentah" class="form-label">Jumlah</label>
                      <input type="number" name="jumlah_barang_mentah[]" id="jumlah_barang_mentah" class="form-control" value="{{ old('jumlah_barang_mentah') }}">
                    </div>
                    @error('jumlah_barang_mentah')
                      <small class="text-danger pesan-error">{{ $message }}</small>
                    @enderror
                  </div>

  tambahBtn.addEventListener('click', function(){
    const barangMentahRecord = document.createElement('div');
    barangMentahRecord.classList.add('mb-3', 'row');
    
  });
  console.log(tambahBtn);
</script>