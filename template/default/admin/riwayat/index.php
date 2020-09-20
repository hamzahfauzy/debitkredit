<?php if($success = session()->get('success')): ?>
<div class="alert alert-success" role="alert">
	<?=$success?>
</div>
<?php session()->reset('success'); endif ?>
<?php if(empty($riwayat)) echo "<i>Tidak ada data</i>"; ?>
<ul class="list">
	<?php foreach($riwayat as $n): ?>
	<li>
		<a href="<?=base_url()?>/admin/nasabah/show/<?=$n->nasabah_id?>" style="font-size: 16px;"><?=$n->nasabah()->nama?> (<?=$n->tipe == 1 ? 'Debit' : 'Kredit' ?>)</a><br>
		Jumlah : Rp. <span class="text-success" style="font-weight: bold;"><?=number_format($n->jumlah)?></span><br>
		Tanggal : <?=$n->tanggal?><br>
		<a href="<?=base_url()?>/admin/riwayat/hapus/<?=$n->id?>" class="hapus">Hapus</a>
	</li>
	<?php endforeach ?>
</ul>