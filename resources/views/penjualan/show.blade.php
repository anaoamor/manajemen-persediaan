<x-app-layout>
  <x-nav-bar/>
  <x-side-bar/>
  <div class="wrapper">
    <!-- Main Content -->
    <div id="main">
      
        <div class="row justify-content-center">
          <div class="col-auto py-4">
            <h2 class="h2 me-auto">Penjualan</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-8">

            <div class="mb-3">
              <label for="id_penjualan" class="form-label">ID</label>
              <input type="text" class="form-control bg-white" name="id_penjualan" id="id_penjualan" readonly value="{{ $penjualan->id }}">  
            </div>
            <div class="mb-3">
              <label for="waktu" class="form-label">Waktu</label>
              <input type="text" class="form-control bg-white" name="waktu" id="waktu" readonly value="{{ \Carbon\Carbon::parse($penjualan->waktu)->isoFormat('dddd, DD MMMM Y HH:mm') }}">  
            </div>

            <!-- Form untuk proses insert -->
            <fieldset class="mb-3 border rounded-3 p-3">
              <legend class="float-none w-auto px-3">Item</legend>
              <div id="barang-jadi-container" class="container">
                @foreach ($penjualan->barangDijual as $item)
                  <div class="row barang-jadi-row mb-3 align-items-center">
                    <div class="col">
                      <label class="form-label" name="barang-jadi[]" data-harga-minimal="{{ $item->barangJadi->harga_minimal }}">{{ $item->barangJadi->nama }}</label>
                    </div>
                    <div class="col">
                      <input type="number" readonly class="form-control bg-white" name="jumlah_barang_jadi[]" placeholder="Jumlah" value="{{ $item->jumlah }}">
                    </div>
                    <div class="col justify-content-end">
                      <p class="total_harga_per_barang col-form-label">{{ Number::currency($item->jumlah * $item->barangJadi->harga_minimal, 'IDR', 'id', 0) }}</p>
                    </div>
                  </div>  
                @endforeach
                
            </div>
            </fieldset>
            <div class="row mb-3 justify-content-end">
              <div class="col"></div>
              <div class="col"></div>
              <div class="col">
                <p id="total_harga"></p>
              </div>
            </div>
            <div class="mb-3">
              <label for="total_pembayaran" class="form-label">Total Pembayaran</label>
              <input type="text" class="form-control bg-white" name="total_pembayaran" id="total_pembayaran" placeholder="100000" readonly value="{{ Number::currency($penjualan->total_pembayaran, 'IDR', 'id', 0) }}">  
            </div>
            <fieldset class="border rounded-3 p-3">
              <legend class="float-none w-auto px-3">Pembeli</legend>
              <div class="mb-3">
                <label for="id_pembeli">Pembeli</label>
                <input id="id_pembeli" readonly type="text" class="form-control bg-white" value="{{ $penjualan->pembeli->nama }}">
              </div>
              <div class="mb-3">
                <label for="no_telepon" class="form-label">No Telepon</label>
                <input readonly type="text" class="form-control bg-white" name="no_telepon" id="no_telepon" value="{{ $penjualan->pembeli->no_telepon }}">
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea readonly name="alamat" id="alamat" class="form-control bg-white" rows="5">{{ $penjualan->pembeli->alamat }}</textarea>
              </div>
            </fieldset>
            <br>
            <br>
            <div class="mb-3">
              <a href="{{ route('penjualan.index') }}" class="btn btn-info text-white" style="width: 95px">OK</a>
            </div>
            
          </div>
        </div>

    </div>
  </div>
  
</x-app-layout>
<script>
  const totalHargaP = document.getElementById('total_harga');

  const idrFormat = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0,
  });

  const calculateTotalHarga = function(){
    const barangJadiLabels = document.querySelectorAll("label[name='barang-jadi[]']");
    
    const jumlahBarangJadiInputs = document.querySelectorAll("input[name='jumlah_barang_jadi[]']");
    var totalHarga = 0;
    barangJadiLabels.forEach((barangJadiLabel, index) => {
      totalHarga += (barangJadiLabel.dataset.hargaMinimal * jumlahBarangJadiInputs[index].value);
    });
    totalHargaP.textContent = idrFormat.format(totalHarga);
  }

  calculateTotalHarga();
</script>