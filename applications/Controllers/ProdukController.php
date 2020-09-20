<?php
namespace App\Controllers;
if (!defined('Z_MVC')) die ("Not Allowed");

use App\Helpers\AdminMiddleware;
use App\Models\Produk;

class ProdukController
{
	function __construct()
	{
		new AdminMiddleware;
		$this->produk = new Produk;
	}

	function index()
	{
		$produk = $this->produk->get();
		return view('produk.index',[
			'produk' => $produk
		]);
	}

	function tambah()
	{
		$request = request()->post();
		if($request)
		{
			$this->produk->save([
				'nama' => $request->nama,
				'harga' => $request->harga
			]);
			session()->set('success','Data Produk Berhasil di Simpan');
			redirect('/produk');
			return;
		}
		return view('produk.tambah');
	}

	function edit($id)
	{
		$request = request()->post();
		$produk = $this->produk->find($id);
		if($request)
		{
			$produk->save([
				'nama' => $request->nama,
				'harga' => $request->harga
			]);
			session()->set('success','Data Produk Berhasil di Update');
			redirect('/produk');
			return;
		}
		return view('produk.edit',[
			'produk' => $produk
		]);
	}

	function hapus($id)
	{
		$produk = $this->produk->delete($id);
		session()->set('success','Data Produk Berhasil di Hapus');
		redirect('/produk');
	}
}