<?php
namespace App\Controllers;
if (!defined('Z_MVC')) die ("Not Allowed");

use App\Helpers\AdminMiddleware;
use App\Models\Trend;
use App\Models\Produk;

class TrendController
{
	function __construct()
	{
		new AdminMiddleware;
		$this->trend = new Trend;
		$this->produk = new Produk;
	}

	function index()
	{
		$trend = $this->trend->orderby('tahun','asc, bulan asc')->get();
		return view('trend.index',[
			'trend' => $trend
		]);
	}

	function tambah()
	{
		$request = request()->post();
		if($request)
		{
			$this->trend->save([
				'id_produk' => $request->id_produk,
				'bulan' => $request->bulan,
				'tahun' => $request->tahun,
				'jumlah' => $request->jumlah
			]);
			session()->set('success','Trend Data Penjualan Berhasil di Simpan');
			redirect('/trend');
			return;
		}
		$produk = $this->produk->get();
		return view('trend.tambah',[
			'produk' => $produk
		]);
	}

	function edit($id)
	{
		$request = request()->post();
		$trend = $this->trend->find($id);
		if($request)
		{
			$trend->save([
				'id_produk' => $request->id_produk,
				'bulan' => $request->bulan,
				'tahun' => $request->tahun,
				'jumlah' => $request->jumlah
			]);
			session()->set('success','Trend Data Penjualan Berhasil di Update');
			redirect('/trend');
			return;
		}
		$produk = $this->produk->get();
		return view('trend.edit',[
			'trend' => $trend,
			'produk' => $produk
		]);
	}

	function hapus($id)
	{
		$trend = $this->trend->delete($id);
		session()->set('success','Trend Data Penjualan Berhasil di Hapus');
		redirect('/trend');
	}

	function hasil()
	{
		$trend = new Trend; // $this->trend->orderby('tahun','asc, bulan asc')->get();
		$produk = $this->produk->get();
		return view('trend.hasil',[
			'trend_model' => $trend,
			'produk' => $produk,
		]);
	}
}