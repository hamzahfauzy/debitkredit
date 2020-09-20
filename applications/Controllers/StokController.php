<?php
namespace App\Controllers;
if (!defined('Z_MVC')) die ("Not Allowed");

use App\Helpers\AdminMiddleware;
use App\Models\{Stok,Produk};

class StokController
{
	function __construct()
	{
		new AdminMiddleware;
		$this->stok = new Stok;
		$this->produk = new Produk;
	}

	function index()
	{
		return view('stok.index',[
			'stok' => $this->stok->orderby('tanggal','desc')->get()
		]);
	}

	function tambah()
	{
		$request = request()->post();
		if($request)
		{
			$current_stok = Stok::where('id_produk',$request->id_produk)->orderby('tanggal','desc')->first();
			$jumlah = 0;
			if(!empty($current_stok))
				$jumlah = $current_stok->jumlah;
			$stok = $this->stok->save([
				'id_produk' => $request->id_produk,
				'jumlah' => $request->jumlah,
				'sisa'   => $jumlah+$request->jumlah,
				'keterangan' => 'penambahan stok',
				'tanggal' => date('Y-m-d H:i:s')
			]);
			session()->set('success','Stok Berhasil di Update');
			redirect('/stok');
			return;
		}
		$produk = $this->produk->get();
		return view('stok.tambah',[
			'produk' => $produk
		]);
	}
}