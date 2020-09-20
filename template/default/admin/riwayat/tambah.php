<form method="post">
    <input type="hidden" name="tipe" value="<?=request()->get()->tipe?>">
    <h4>Identitas Nasabah</h4>
    <hr>
    <div class="form-group">
        <label>Nasabah</label>
        <select name="nasabah_id" class="form-control nasabah_id" required="">
            <option value="">Pilih</option>
            <?php foreach($nasabah as $n): ?>
            <option value="<?=$n->id?>"><?=$n->nama?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <textarea readonly="" class="form-control alamat"></textarea>
    </div>
    <div class="form-group">
        <label>No HP</label>
        <input type="text" readonly="" class="form-control no_hp">
    </div>
    <br>
    <h4>Detail</h4>
    <hr>
    <div class="form-group">
        <label>Uraian</label>
        <input type="text" name="uraian" class="form-control" required="">
    </div>
    <div class="form-group">
        <label>Jumlah</label>
        <input type="number" name="jumlah" class="form-control" required="">
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Simpan</button>
    </div>
</form>
<script type="text/javascript">
$(".nasabah_id").change(async (e) => {
    var val = $(e.target).val()
    var request = await fetch('<?=base_url()?>/admin/nasabah/detail/'+val)
    var response = await request.json();

    $('.alamat').val(response.alamat)
    $('.no_hp').val(response.no_hp)
})
</script>