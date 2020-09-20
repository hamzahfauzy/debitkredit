<?php if($success = session()->get('success')): ?>
<div class="alert alert-success" role="alert">
	<?=$success?>
</div>
<?php session()->reset('success'); endif ?>
<?php if(empty($nasabah)) echo "<i>Tidak ada data</i>"; ?>
<ul class="list">
	<?php foreach($nasabah as $n): ?>
	<li>
		<a href="<?=base_url()?>/admin/nasabah/show/<?=$n->id?>" style="font-size: 16px"><?=$n->nama?></a><br>
		<a href="<?=base_url()?>/admin/nasabah/edit/<?=$n->id?>" class="edit">Edit</a>
		|
		<a href="<?=base_url()?>/admin/nasabah/hapus/<?=$n->id?>" class="hapus">Hapus</a>
	</li>
	<?php endforeach ?>
</ul>
<a href="<?=base_url()?>/admin/nasabah/tambah" class="kc_fab_main_btn"><i class="fa fa-plus"></i></a>