<?php if(empty($riwayat)) echo "<i>Tidak ada data</i>"; ?>
<ul class="list">
	<?php foreach($riwayat as $n): ?>
	<li>
		<a href="<?=base_url()?>/admin/nasabah/show/<?=$n->nasabah_id?>" style="font-size: 16px;"><?=$n->nasabah()->nama?> (<?=$n->tipe == 1 ? 'Debit' : 'Kredit' ?>)</a><br>
		Jumlah : Rp. <span class="text-success" style="font-weight: bold;"><?=number_format($n->jumlah)?></span><br>
		Tanggal : <?=$n->tanggal?><br>
	</li>
	<?php endforeach ?>
</ul>