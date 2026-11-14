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

            <!-- Form untuk proses insert -->
            <form method="post" action="{{ route('penjualan.store') }}">
              @csrf
              <fieldset class="mb-3 border rounded-3 p-3">
                <legend class="float-none w-auto px-3">Item</legend>
                <div class="row mb-3 align-items-center">
                  <div class="col">
                    <small class="text-danger pesan-error" id="id-barang-jadi-error"></small>
                  </div>
                  <div class="col">
                    <small class="text-danger pesan-error" id="jumlah-barang-jadi-error"></small>
                  </div>
                  <div class="col"></div>
                  <div class="col"></div>
                </div>
                <div id="barang-jadi-container" class="container">
                  <div class="row barang-jadi-row mb-3 align-items-center">
                    <div class="col">
                      <select class="form-select" name="id_barang_jadi[]" id="id_barang_jadi_0" aria-label="Barang Jadi">
                        <option value="">Pilih Item</option>
                        @foreach ($barangJadis as $barangJadi)
                          <option value="{{ $barangJadi->id }}" data-stok="{{ $barangJadi->jumlah }}" data-harga-minimal="{{ $barangJadi->harga_minimal }}">
                            {{ $barangJadi->nama }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col">
                      <input type="number" class="form-control" name="jumlah_barang_jadi[]" id="jumlah_barang_jadi_0" placeholder="Jumlah">
                    </div>
                    <div class="col justify-content-end">
                      <p class="total_harga_per_barang col-form-label" id="total_harga_per_barang"></p>
                    </div>
                    <div class="col">
                      <button class="btn btn-info text-white tambah-btn"  style="width: 95px">Tambah</button>
                    </div>
                  </div>
              </div>
              </fieldset>
              <div class="row mb-3 justify-content-end">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col">
                  <p id="total_harga"></p></div>
              </div>
              <div class="mb-3">
                <label for="total_pembayaran" class="form-label">Total Pembayaran</label>
                <input type="number" class="form-control" name="total_pembayaran" id="total_pembayaran" placeholder="100000">
                <small class="text-danger pesan-error" id="total_pembayaran_error"></small>  
              </div>
              <fieldset class="border rounded-3 p-3">
                <legend class="float-none w-auto px-3">Pembeli</legend>
                <div class="mb-3">
                  <label for="id_pembeli">Pembeli</label>
                  <select class="form-select" name="id_pembeli" id="id_pembeli" aria-label="Pembeli">
                    <option value="">Pilih pembeli</option>
                    @foreach ($pembelis as $pembeli)
                      <option @selected(old('id_pembeli') == $pembeli->id) value="{{ $pembeli->id }}" data-id="{{ $pembeli->id }}" data-nama="{{ $pembeli->nama }}" data-no_telepon="{{ $pembeli->no_telepon }}" data-alamat="{{ $pembeli->alamat }}">
                        {{ $pembeli->nama }}
                      </option>
                    @endforeach
                  </select>
                    <small class="text-danger pesan-error" id="id_pembeli_error"></small>
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
                <a id="btn-cancel" href="{{ route('penjualan.index') }}" class='btn btn-secondary' style="width: 95px;">Batal</a>
              </div>
              
            </form>
            <template id="barang-jadi-template">
              <div class="row barang-jadi-row mb-3 align-items-center">
                <div class="col">
                  <select class="form-select" name="id_barang_jadi[]" aria-label="Barang Jadi">
                    <option value="">Pilih Item</option>
                    @foreach ($barangJadis as $barangJadi)
                      <option value="{{ $barangJadi->id }}" data-stok="{{ $barangJadi->jumlah }}" data-harga-minimal="{{ $barangJadi->harga_minimal }}">
                        {{ $barangJadi->nama }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="col">
                  <input type="number" class="form-control" name="jumlah_barang_jadi[]" placeholder="Jumlah">
                </div>
                <div class="col justify-content-end">
                  <p class="total_harga_per_barang col-form-label"></p>
                </div>
                <div class="col">
                  <button class="btn btn-danger hapus-btn" style="width: 95px">Hapus</button>
                </div>
              </div>
            </template>
          </div>
        </div>

    </div>
  </div>
  
</x-app-layout>
<script>
  const barangJadiContainer = document.getElementById('barang-jadi-container');
  const barangJadiTemplate = document.getElementById('barang-jadi-template');
  const tambahBtn = document.querySelectorAll('.tambah-btn');

  const idPembeliSelect = document.getElementById('id_pembeli');

  const penjualanForm = document.querySelector('form');

  const idBarangJadiError = document.getElementById('id-barang-jadi-error');
  const jumlahBarangJadiError = document.getElementById('jumlah-barang-jadi-error');  
  const barangJadiSelect0 = document.getElementById('id_barang_jadi_0');
  const jumlahBarangJadiInput0 = document.getElementById('jumlah_barang_jadi_0');

  const totalHargaPerBarangP = document.getElementById('total_harga_per_barang');
  const totalHargaP = document.getElementById('total_harga');

  const idrFormat = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0,
  });

  //validate barang jadi chosen, stok available, and show current total harga
  jumlahBarangJadiInput0.addEventListener('input', function(e){
    idBarangJadiError.textContent = '';
    jumlahBarangJadiError.textContent = '';

    var totalHargaPerBarang = 0;
    const selectedBarangJadi = barangJadiSelect0.selectedOptions[0];
    if(selectedBarangJadi.value === ""){
      idBarangJadiError.textContent ="Pilih barang mentah terlebih dahulu";
    }
    if(Number(e.target.value) > Number(selectedBarangJadi.dataset.stok)){
      jumlahBarangJadiError.textContent = "Jumlah tidak boleh melebihi stok";
    }

    totalHargaPerBarang = selectedBarangJadi.dataset.hargaMinimal * e.target.value;

    totalHargaPerBarangP.textContent = idrFormat.format(totalHargaPerBarang);
    calculateTotalHarga();
  });

  //Update total harga
  barangJadiSelect0.addEventListener('change', function(){
    totalHargaPerBarangP.textContent = idrFormat.format(event.target.selectedOptions[0].dataset.hargaMinimal * jumlahBarangJadiInput0.value);
    calculateTotalHarga();
  });

  const calculateTotalHarga = function(){
    const barangJadiSelects = document.querySelectorAll("select[name='id_barang_jadi[]']");
    const jumlahBarangJadiInputs = document.querySelectorAll("input[name='jumlah_barang_jadi[]']");
    var totalHarga = 0;
    barangJadiSelects.forEach((barangJadiSelect, index) => {
      totalHarga += (barangJadiSelect.selectedOptions[0].dataset.hargaMinimal * jumlahBarangJadiInputs[index].value);
    });
    totalHargaP.textContent = idrFormat.format(totalHarga);
  }
  
  tambahBtn.forEach(btn => {
    btn.addEventListener('click', function(e){
      e.preventDefault();
      const clone = barangJadiTemplate.content.cloneNode(true);
      const newBarangJadiSelect = clone.querySelector('select');
      const newJumlahBarangJadiInput = clone.querySelector('input');
      const newTotalHargaPerBarangP = clone.querySelector('p');
      
      var newTotalHargaPerBarang = 0;

      barangJadiContainer.appendChild(clone);

      newJumlahBarangJadiInput.addEventListener('input', function(event){
        idBarangJadiError.textContent = '';
        jumlahBarangJadiError.textContent = '';
        const selectedBarangJadi = newBarangJadiSelect.selectedOptions[0];
        if(selectedBarangJadi.value === ""){
          idBarangJadiError.textContent = "Pilih item terlebih dahulu";
        }
        if(Number(event.target.value) > Number(selectedBarangJadi.dataset.stok)){
          jumlahBarangJadiError.textContent = "Jumlah tidak boleh melebih stok";
        }
         newTotalHargaPerBarang = event.target.value * selectedBarangJadi.dataset.hargaMinimal;
         newTotalHargaPerBarangP.textContent = idrFormat.format(newTotalHargaPerBarang);
         calculateTotalHarga();
      });

      newBarangJadiSelect.addEventListener('change', function(event){
        newTotalHargaPerBarangP.textContent = idrFormat.format(event.target.selectedOptions[0].dataset.hargaMinimal * newJumlahBarangJadiInput.value);
        calculateTotalHarga();
      });
      
    });
  }); 

  barangJadiContainer.addEventListener('click', function(e){
    if(e.target.classList.contains('hapus-btn')){
      e.preventDefault();
      const row = e.target.closest('.barang-jadi-row').remove(); 
      calculateTotalHarga();       
    }
  });

  idPembeliSelect.addEventListener('change', function(){
    const idPembeli = this.selectedOptions[0];
    document.getElementById('no_telepon').value = idPembeli.dataset.no_telepon ?? '';
    document.getElementById('alamat').value = idPembeli.dataset.alamat ?? '';

    if(!idPembeli | !this.value){
      document.getElementById('no_telepon').value = '';
      document.getElementById('alamat').value = '';

      return;
    }
  });

  penjualanForm.addEventListener('submit', function(e){

    var isValid = true;
    const totalPembayaranInput = document.getElementById('total_pembayaran');
  
    const totalPembayaranError = document.getElementById('total_pembayaran_error');
    const idPembeliError = document.getElementById('id_pembeli_error');
    
    // Reset error messages
    totalPembayaranError.textContent = '';
    idPembeliError.textContent = '';

    const totalPembayaran = totalPembayaranInput.value.trim();
    const idPembeli = idPembeliSelect.selectedOptions[0].value;
    
    //Validate form input
    if(idPembeli === ''){
      idPembeliError.textContent = 'Pembeli harus dipilih.';
      isValid = false;
    }
    const harga = /^[1-9]+[0-9]{4,}$/;
    if(!harga.test(totalPembayaran)){
      totalPembayaranError.textContent = 'Jumlah harus angka';
      isValid = false;
    }else if(totalPembayaran<=0){
      totalPembayaranError.textContent = 'Jumlah harus lebih besar dari 0';
      isValid = false;
    }
    if(barangJadiSelect0.value === ""){
      idBarangJadiError.textContent = "Minimal 1 barang jadi";
      isValid = false;
    }
    const jumlahPattern = /^[1-9]+[0-9]*$/;
    if(!jumlahPattern.test(jumlahBarangJadiInput0.value)){
      jumlahBarangJadiError.textContent = "Jumlah harus angka";
      isValid = false;
    }

    if(!isValid){
      e.preventDefault();
    }
    
  });

</script>