<div class="col-sm-6">
    <!-- Nama Usaha -->
    <div class="form-group">
        <label for="">Nama Usaha  <span style="color: #FF0000;">*</span></label>
        <input type="text" class="form-control" name="Nama_Usaha" id="Nama_Usaha" required placeholder="Nama Usaha">
    </div>

    <!-- Nama Pemilik_Usaha -->
    <div class="form-group">
        <label for="">Nama Pemilik Usaha  <span style="color: #FF0000;">*</span></label>
        <input type="text" class="form-control only-string" name="Nama_Pemilik_Usaha" id="Nama_Pemilik_Usaha" required placeholder="Nama Pemilik Usaha">
    </div>

    <!-- Sektor Usaha -->
    <div class="form-group">
        <label for="">Sektor Usaha  <span style="color: #FF0000;">*</span></label>
        <select name="Sektor_Usaha" id="Sektor_Usaha" class="form-control" required>
            <option disabled selected="selected">-- Pilih Sektor --</option>
            @foreach($data['data_usaha'] as $data_usaha)
                <option value="{{ $data_usaha->Kode_Sektor }}">{{ $data_usaha->Sektor_Usaha }}</option>
            @endforeach
        </select>
    </div>

    <!-- NPWP -->
    <div class="form-group">
        <label for="">NPWP  <span style="color: #FF0000;">*</span></label>
        <!-- <input type="text" class="form-control only-number" name="NPWP" id="NPWP" required placeholder="NPWP"> -->
        <select name="NPWP" id="NPWP" class="form-control" required>
            <option disabled selected="selected">-- NPWP --</option>
            <option value="ada">Ada</option>
            <option value="tidak">Kosong/Tidak ada</option>
        </select>
    </div>

    <div class="form-group">
        <label for="">Tahun Mulai  <span style="color: #FF0000;">*</span></label>
        <div class="input-group mb-3">
            <input type="text" class="form-control only-number" required id="Tahun_Mulai" name="Tahun_Mulai" placeholder="Tahun Mulai (Ex: 2016)">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    
    <!-- Desa -->
    <div class="form-group">
        <label for="">Kelurahan  <span style="color: #FF0000;">*</span></label>
        <select name="Kelurahan" id="Kelurahan" class="form-control" required>
            <option disabled selected="selected">-- Pilih Kelurahan --</option>
            @foreach($data['data_kelurahan']['kelurahan'] as $data_kelurahan)
                <option value="{{ $data_kelurahan['nama'] }}">{{ $data_kelurahan['nama'] }}</option>
            @endforeach
        </select>
    </div>

</div>

<!-- Form 2 -->
<div class="col-sm-6">
    <!-- KTP -->
    <div class="form-group">
        <label for="">KTP  <span style="color: #FF0000;">*</span></label>
        <input type="text" class="form-control only-number" minlength="16" maxlength="16" name="KTP" id="KTP" required placeholder="KTP">
    </div>
    <!-- No_Telp -->
    <div class="form-group">
        <label for="">Nomor Telp  <span style="color: #FF0000;">*</span></label>
        <input type="text" class="form-control" name="No_Telp" id="No_Telp" required placeholder="Nomor Telepon">
    </div>
    <!-- Email -->
    <div class="form-group">
        <label for="">Email  <span style="color: #FF0000;">*</span></label>
        <input type="email" class="form-control" name="Email" id="Email" required placeholder="Email">
    </div>
    <!-- Password -->
    <div class="form-group">
        <label for="">Password  <span style="color: #FF0000;">*</span></label>
        <input type="password" class="form-control" name="Password" id="Password" required placeholder="Password">
    </div>
    <div class="form-group">
        <label for="">Retype Password  <span style="color: #FF0000;">*</span></label>
        <input type="password" onkeyup="check()" class="form-control" name="Retype_Password" id="Retype_Password" required placeholder="Retype Password">
    </div>
    <!-- Alamat -->
    <div class="form-group">
        <label for="">Alamat  <span style="color: #FF0000;">*</span></label>
        <textarea class="form-control" name="Alamat_Jalan" id="Alamat_Jalan" cols="30" rows="5" required placeholder="Alamat Jalan"></textarea>
    </div>
</div>
