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

            <div class="mb-3">
              <label for="id_barang_jadi" class="form-label">ID</label>
              <input type="text" class="form-control bg-white" name="id_barang_jadi" id="id_barang_jadi" readonly value="{{ $pembuatan->id }}">
            </div>
            <div class="mb-3">
              <label for="nama_barang_jadi" class="form-label">Nama</label>
              <input type="text" class="form-control bg-white" name="nama_barang_jadi" id="nama_barang_jadi" readonly value="{{ $barangJadi->nama }}">
            </div>
            <div class="mb-3">
              <label for="jumlah_barang_jadi" class="form-label">Jumlah</label>
              <input type="text" class="form-control bg-white" name="jumlah_barang_jadi" id="jumlah_barang_jadi" readonly value="{{ $barangJadi->jumlah }}">
            </div>
            <div class="mb-3">
              <label for="waktu" class="form-label">Waktu</label>
              <input type="text" class="form-control bg-white" name="waktu" id="waktu" readonly value="{{ \Carbon\Carbon::parse($pembuatan->waktu)->isoFormat('dddd, DD MMMM Y HH:mm') }}">
            </div>
            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <input type="text" class="form-control bg-white" name="status" id="status" readonly value="{{ $pembuatan->status }}">
            </div>
            <div class="mb-3">
              <label for="kategori" class="form-label">Kategori</label>
              <input type="text" name="kategori" id="kategori" class="form-control bg-white" readonly value="{{ $kategori->nama }}">
            </div>

            <fieldset class="mb-3 border rounded-3 p-3">
              <legend class="float-none w-auto px-3">Barang Mentah</legend>
              <div id="barang-mentah-container" class="container">
                @foreach ($barangMentahDipakais as $key => $barangMentahDipakai)
                  <div class="row barang-mentah-row mb-3 align-items-center">
                    <div class="col">
                      <label class="form-label">{{ $namaBarangMentahs[$key] }}</label>
                    </div>
                    <div class="col">
                      <input type="number" class="form-control bg-white"  value="{{ $barangMentahDipakai->jumlah }}" readonly>
                    </div>
                  </div>  
                @endforeach
                
            </div>
            </fieldset>
            <br>
            <br>
            <div class="mb-3">
              <a href="{{ route('pembuatan.index') }}" class='btn btn-info text-white' style="width: 95px;">OK</a>
            </div>
            
          </div>
        </div>

    </div>
  </div>

</x-app-layout>