<div class="sidebar hide">
	<ul>
		<li>
			<a href="<?=base_url()?>"><i class="fa fa-fw fa-home"></i> Home</a>
		</li>
		<?php if(session()->user()->level == 'admin'): ?>
		<li>
			<a href="<?=base_url()?>/admin/nasabah"><i class="fa fa-fw fa-users"></i> Anggota</a>
		</li>
		<li>
			<a href="<?=base_url()?>/admin/riwayat/tambah?tipe=1"><i class="fa fa-fw fa-money"></i> Input Debit</a>
		</li>
		<li>
			<a href="<?=base_url()?>/admin/riwayat/tambah?tipe=2"><i class="fa fa-fw fa-credit-card"></i> Input Kredit</a>
		</li>
		<li>
			<a href="<?=base_url()?>/admin/riwayat"><i class="fa fa-fw fa-credit-card-alt"></i> Debet & Kredit</a>
		</li>
		<?php else: ?>
		<li>
			<a href="<?=base_url()?>/nasabah/index"><i class="fa fa-fw fa-user"></i> Detail</a>
		</li>
		<li>
			<a href="<?=base_url()?>/nasabah/riwayat"><i class="fa fa-fw fa-credit-card-alt"></i> Debet & Kredit</a>
		</li>
		<?php endif ?>
		<li>
			<a href="<?=base_url()?>/auth/logout"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
		</li>
	</ul>
</div>