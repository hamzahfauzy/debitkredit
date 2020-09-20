<?php
namespace App\Controllers\Admin;
if (!defined('Z_MVC')) die ("Not Allowed");

use App\Helpers\AdminMiddleware;
use App\Models\Nasabah;
use App\Models\Riwayat;
use App\Models\User;

class RiwayatController
{
	function __construct()
	{
		new AdminMiddleware;
		$this->nasabah = new Nasabah;
		$this->riwayat = new Riwayat;
		$this->user = new User;
	}

	function index()
	{
		$riwayat = $this->riwayat->get();
		return view('admin.riwayat.index',[
			'riwayat' => $riwayat
		]);
	}

	function tambah()
	{
		$request = request()->post();
		if($request)
		{
			$request->user_id = session()->get('id');
			$request->tanggal = date('Y-m-d');
			$this->riwayat->save((array) $request);
			session()->set('success','Data riwayat Berhasil di Simpan');
			redirect('/admin/riwayat');
			return;
		}
		$nasabah = $this->nasabah->get();
		return view('admin.riwayat.tambah',[
			'nasabah' => $nasabah
		]);
	}

	function edit($id)
	{
		$request = request()->post();
		$riwayat = $this->riwayat->find($id);
		if($request)
		{
			$user = $this->user->find($riwayat->user_id);
			if($request->pengguna->password != "")
				$request->pengguna->password = md5($request->pengguna->password);
			else
				$request->pengguna->password = $user->getPassword();
			$user->save((array) $request->pengguna);

			$riwayat->save((array) $request->riwayat);

			session()->set('success','Data riwayat Berhasil di Update');
			redirect('/admin/riwayat');
			return;
		}
		return view('admin.riwayat.edit',[
			'riwayat' => $riwayat
		]);
	}

	function hapus($id)
	{
		$riwayat = $this->riwayat->delete($id);
		session()->set('success','Data riwayat Berhasil di Hapus');
		redirect('/admin/riwayat');
	}
}