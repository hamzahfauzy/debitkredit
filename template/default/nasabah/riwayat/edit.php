<form method="post">
    <h4>Identitas Nasabah</h4>
    <hr>
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nasabah[nama]" class="form-control" value="<?=$nasabah->nama?>" required="">
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <textarea name="nasabah[alamat]" class="form-control" required=""><?=$nasabah->alamat?></textarea>
    </div>
    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select name="nasabah[jenis_kelamin]" class="form-control" required="">
            <option value="">Pilih</option>
            <option <?=$nasabah->jenis_kelamin=='Laki-laki'?'selected':''?>>Laki-laki</option>
            <option <?=$nasabah->jenis_kelamin=='Perempuan'?'selected':''?>>Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label>No HP</label>
        <input type="text" name="nasabah[no_hp]" value="<?=$nasabah->no_hp?>" class="form-control" required="">
    </div>
    <br>
    <h4>Identitas Akun</h4>
    <hr>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="pengguna[username]" value="<?=$nasabah->user()->username?>" class="form-control" required="">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="pengguna[password]" class="form-control">
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Simpan</button>
    </div>
</form>