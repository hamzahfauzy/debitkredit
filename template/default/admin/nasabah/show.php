<h4>Identitas Nasabah</h4>
<hr>
<div class="form-group">
    <b>Nama</b><br>
    <?=$nasabah->nama?>
</div>
<div class="form-group">
    <b>Alamat</b><br>
    <?=$nasabah->alamat?>
</div>
<div class="form-group">
    <b>Jenis Kelamin</b><br>
    <?=$nasabah->jenis_kelamin?>
</div>
<div class="form-group">
    <b>No HP</b><br>
    <?=$nasabah->no_hp?>
</div>
<br>
<h4>Status : </h4>
<hr>
<div class="form-group">
    <b>Debit</b><br>
    Rp. <?=number_format($nasabah->debet()['total'])?>
</div>
<div class="form-group">
    <b>Kredit</b><br>
    Rp. <?=number_format($nasabah->kredit()['total'])?>
</div>
<div class="form-group">
    <b>Sisa</b><br>
    Rp. <?=number_format($nasabah->sisa())?>
</div>