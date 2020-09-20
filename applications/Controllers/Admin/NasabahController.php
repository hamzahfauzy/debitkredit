<?php
namespace App\Controllers\Admin;
if (!defined('Z_MVC')) die ("Not Allowed");

use App\Helpers\AdminMiddleware;
use App\Models\Nasabah;
use App\Models\User;

class NasabahController
{
	function __construct()
	{
		new AdminMiddleware;
		$this->nasabah = new Nasabah;
		$this->user = new User;
	}

	function detail($id)
	{
		return $this->nasabah->find($id);
	}

	function show($id)
	{
		return view('admin.nasabah.show',[
			'nasabah' => $this->nasabah->find($id)
		]);
	}

	function index()
	{
		$nasabah = $this->nasabah->get();
		return view('admin.nasabah.index',[
			'nasabah' => $nasabah
		]);
	}

	function tambah()
	{
		$request = request()->post();
		if($request)
		{
			$request->pengguna->password = md5($request->pengguna->password);
			$request->pengguna->level = 'nasabah';
			$user = $this->user->save((array) $request->pengguna);

			$request->nasabah->user_id = $user;
			$this->nasabah->save((array) $request->nasabah);
			session()->set('success','Data nasabah Berhasil di Simpan');
			redirect('/admin/nasabah');
			return;
		}
		return view('admin.nasabah.tambah');
	}

	function edit($id)
	{
		$request = request()->post();
		$nasabah = $this->nasabah->find($id);
		if($request)
		{
			$user = $this->user->find($nasabah->user_id);
			if($request->pengguna->password != "")
				$request->pengguna->password = md5($request->pengguna->password);
			else
				$request->pengguna->password = $user->getPassword();
			$user->save((array) $request->pengguna);

			$nasabah->save((array) $request->nasabah);

			session()->set('success','Data nasabah Berhasil di Update');
			redirect('/admin/nasabah');
			return;
		}
		return view('admin.nasabah.edit',[
			'nasabah' => $nasabah
		]);
	}

	function hapus($id)
	{
		$nasabah = $this->nasabah->delete($id);
		session()->set('success','Data nasabah Berhasil di Hapus');
		redirect('/admin/nasabah');
	}
}