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
                <label for="nama_barang_jadi" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama_barang_jadi" id="nama_barang_jadi">
                <small class="text-danger pesan-error" id="nama_barang_jadi_error"></small>  
              </div>
              <div class="mb-3">
                <label for="id_kategori" class="form-label">Kategori</label>
                <select name="id_kategori" id="id_kategori" class="form-select" aria-label="Kategori">
                  <option value="">Pilih kategori</option>
                  @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                  @endforeach
                </select>
                <small class="text-danger pesan-error" id="id_kategori_error"></small>
              </div>

              <fieldset class="mb-3 border rounded-3 p-3">
                <legend class="float-none w-auto px-3">Barang Mentah</legend>
                <div class="row mb-3 align-items-center">
                  <div class="col">
                    <small class="text-danger pesan-error" id="id-barang-mentah-error"></small>
                  </div>
                  <div class="col">
                    <small class="text-danger pesan-error" id="jumlah-barang-mentah-error"></small>
                  </div>
                  <div class="col"></div>
                </div>
                <div id="barang-mentah-container" class="container">
                  <div class="row barang-mentah-row mb-3 align-items-center">
                    <div class="col">
                      <select class="form-select" name="id_barang_mentah[]" id="id_barang_mentah_0" aria-label="Barang Mentah">
                        <option value="">Pilih Barang Mentah</option>
                        @foreach ($barangMentahs as $barangMentah)
                          <option value="{{ $barangMentah->id }}" data-stok="{{ $barangMentah->stok }}">
                            {{ $barangMentah->nama }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col">
                      <input type="number" class="form-control" name="jumlah_barang_mentah[]" id="jumlah_barang_mentah_0" placeholder="Jumlah">
                    </div>
                    <div class="col">
                      <button class="btn btn-info text-white tambah-btn"  style="width: 95px">Tambah</button>
                    </div>
                  </div>
              </div>
              </fieldset>
              <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" id="jumlah">
                <small class="text-danger pesan-error" id="jumlah-error"></small>
              </div>
              <br>
              <br>
              <div class="mb-3">
                <input type="submit" value="Simpan" class="btn btn-info text-white" name="submit">
                <a id="btn-cancel" href="{{ route('pembuatan.index') }}" class='btn btn-secondary' style="width: 95px;">Batal</a>
              </div>
              
            </form>
            <template id="barang-mentah-template">
              <div class="row barang-mentah-row mb-3 align-items-center">
                <div class="col">
                  <select class="form-select" name="id_barang_mentah[]" aria-label="Barang Mentah">
                    <option value="">Pilih Barang Mentah</option>
                    @foreach ($barangMentahs as $barangMentah)
                      <option value="{{ $barangMentah->id }}" data-stok="{{ $barangMentah->stok }}">
                        {{ $barangMentah->nama }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="col">
                  <input type="number" class="form-control" name="jumlah_barang_mentah[]" placeholder="Jumlah">
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
  const barangMentahContainer = document.getElementById('barang-mentah-container');
  const barangMentahTemplate = document.getElementById('barang-mentah-template');
  const tambahBtn = document.querySelectorAll('.tambah-btn');

  const pembuatanForm = document.querySelector('form');

  const idBarangMentahError = document.getElementById('id-barang-mentah-error');
  const jumlahBarangMentahError = document.getElementById('jumlah-barang-mentah-error');  
  const barangMentahSelect0 = document.getElementById('id_barang_mentah_0');
  const jumlahBarangMentahInput0 = document.getElementById('jumlah_barang_mentah_0');

  var index = 1;

  jumlahBarangMentahInput0.addEventListener('change', function(){
    jumlahBarangMentahError.textContent = '';
    const selectedBarangMentahStok = barangMentahSelect0.selectedOptions[0].dataset.stok;
    if(this.value > selectedBarangMentahStok){
      jumlahBarangMentahError.textContent = "Jumlah tidak boleh melebihi stok";
    }
  });
  

  tambahBtn.forEach(btn => {
    btn.addEventListener('click', function(e){
      e.preventDefault();
      const clone = barangMentahTemplate.content.cloneNode(true);
      const newBarangMentahSelect = clone.querySelector('select');
      const newJumlahBarangMentahInput = clone.querySelector('input');
      
      clone.querySelector('select').id = 'id_barang_mentah_'+index;
      clone.querySelector('input').id = 'jumlah_barang_mentah_'+index;
      barangMentahContainer.appendChild(clone);

      newJumlahBarangMentahInput.addEventListener('change', function(){
        jumlahBarangMentahError.textContent = '';
        const selectedBarangMentahStok = newBarangMentahSelect.selectedOptions[0];
        if(this.value > selectedBarangMentahStok.dataset.stok){
          jumlahBarangMentahError.textContent = "Jumlah tidak boleh melebih stok";
        }
      });
      
      
      index++;

    });
  }); 

  barangMentahContainer.addEventListener('click', function(e){
    if(e.target.classList.contains('hapus-btn')){
      e.preventDefault();
      const row = e.target.closest('.barang-mentah-row').remove();        
    }
  });

  pembuatanForm.addEventListener('submit', function(e){
    var isValid = true;
    const namaBarangJadiInput = document.getElementById('nama_barang_jadi');
    const idKategoriInput = document.getElementById('id_kategori');
    const jumlahInput = document.getElementById('jumlah');
  
    const namaBarangJadiError = document.getElementById('nama_barang_jadi_error');
    const idKategoriError = document.getElementById('id_kategori_error');
    const jumlahError = document.getElementById('jumlah-error');

    // Reset error messages
    namaBarangJadiError.textContent = '';
    idKategoriError.textContent = '';
    idBarangMentahError.textContent = '';
    jumlahError.textContent = '';

    const namaBarangJadi = namaBarangJadiInput.value.trim();
    const idKategori = idKategoriInput.value;
    const jumlah = jumlahInput.value;
    
    //Validate form input
    if(namaBarangJadi === ''){
      namaBarangJadiError.textContent = 'Nama barang jadi harus diisi.';
      isValid = false;
    }
    if(idKategori === ''){
      idKategoriError.textContent = 'Kategori harus dipilih.';
      isValid = false;
    }
    const pattern = /^[1-9]+[0-9]*$/;
    if(!pattern.test(jumlah)){
      jumlahError.textContent = 'Jumlah harus angka';
      isValid = false;
    }else if(jumlah<=0){
      jumlahError.textContent = 'Jumlah harus lebih besar dari 0';
      isValid = false;
    }
    if(barangMentahSelect0.value === ""){
      idBarangMentahError.textContent = "Minimal 1 barang mentah";
      isValid = false;
    }
    if(!pattern.test(jumlahBarangMentahInput0.value)){
      jumlahBarangMentahError.textContent = "Jumlah harus angka";
      isValid = false;
    }else if(jumlahBarangMentahInput0.value <= 0){
      jumlahBarangMentahError.textContent = 'Jumlah harus lebih dari 0';
      isValid = false;
    }

    if(!isValid){
      e.preventDefault();
    }
    
  });

</script>