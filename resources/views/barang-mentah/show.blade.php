<div>
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
</div>
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
            @if ($barangMentah->stok <= 3)
              <div class='alert alert-danger' role='alert'>Stok telah menipis</div>
            @endif
              <div class="mb-3">
                <label for="id_barang_mentah" class="form-label">ID</label>
                <input readonly type="text" class="form-control bg-white" name="id_barang_mentah" id="id_barang_mentah" value="{{ $barangMentah->id }}">
              </div>
              <div class="mb-3">
                <label for="waktu" class="form-label">Waktu</label>
                <input readonly type="text" class="form-control bg-white" name="waktu" id="waktu" value="{{ \Carbon\Carbon::parse($barangMentah->waktu)->isoFormat('dddd, D MMMM Y HH:mm') }}">
              </div>
              <div class="mb-3">
                <label for="kode_item" class="form-label">Kode Item</label>
                <input readonly type="text" class="form-control bg-white" name="kode_item" id="kode_item" value="{{ $barangMentah->kode_item }}">
              </div>
              <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama</label>
                <input readonly name="nama_barang" id="nama_barang" class="form-control bg-white" value="{{ $barangMentah->nama }}" type="text">
              </div>
              <div class="mb-3">
                <label for="id_kategori" class="form-label">Kategori</label>
                <input readonly name="id_kategori" id="id_kategori" class="form-control bg-white" value="{{ $kategori->nama }}" type="text">
              </div>
              <div class="mb-3">
                <label for="satuan_hitung" class="form-label">Satuan Hitung</label>
                <input readonly name="satuan_hitung" id="satuan_hitung" class="form-control bg-white" value="{{ $barangMentah->satuan_hitung }}" type="text">
              </div>
              <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input readonly type="text" class="form-control bg-white" name="stok" id="stok" value="{{ $barangMentah->stok }}">
              </div>
              <div class="mb-3">
                <label for="ukuran" class="form-label">Ukuran</label>
                <input readonly name="ukuran" id="ukuran" type="text" class="form-control bg-white" value="{{ $barangMentah->ukuran }}">
              </div>
              <div class="mb-3">
                <label for="harga_per_satuan" class="form-label">Harga Per Satuan</label>
                <input readonly type="text" class="form-control bg-white" name="harga_per_satuan" id="harga_per_satuan" value="{{ Number::currency($barangMentah->harga_satuan, 'IDR', 'id') }}">
              </div>
              <fieldset class="border rounded-3 p-3">
                <legend class="float-none w-auto px-3">Pemasok</legend>
                <div class="mb-3">
                  <label for="id_supplier">ID</label>
                  <input readonly name="id_supplier" id="id_supplier" class="form-control bg-white" value="{{ $pemasok->id }}" type="text">
                  </select>
                </div>
                <div class="mb-3">
                  <label for="nama_supplier" class="form-label">Nama</label>
                  <input readonly readonly type="text" class="form-control bg-white bg-white" name="nama_supplier" id="nama_supplier" value="{{ $pemasok->nama }}">
                </div>
                <div class="mb-3">
                  <label for="no_telepon" class="form-label">No Telepon</label>
                  <input readonly readonly type="text" class="form-control bg-white bg-white" name="no_telepon" id="no_telepon" value="{{ $pemasok->no_telepon }}">
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <textarea readonly name="alamat" id="alamat" class="form-control bg-white bg-white" rows="5">{{ $pemasok->alamat }}</textarea>
                </div>
              </fieldset>
              <br>
              <br>
              <div class="mb-3">
                <a href="{{ route('barang-mentah.index') }}" class="btn btn-info text-white" style="width:95px;">OK</a>
              </div>
              
          </div>
        </div>
  

    </div>
  </div>
  
</x-app-layout>