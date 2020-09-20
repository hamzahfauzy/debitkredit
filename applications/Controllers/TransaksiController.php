<?php
namespace App\Controllers;
if (!defined('Z_MVC')) die ("Not Allowed");

use App\Helpers\AdminMiddleware;
use App\Models\Stok;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Trend;
use App\Models\Produk;

class TransaksiController
{
	function __construct()
	{
		new AdminMiddleware;
		$this->stok = new Stok;
		$this->trend = new Trend;
		$this->produk = new Produk;
		$this->transaksi = new Transaksi;
		$this->pelanggan = new Pelanggan;
	}

	function index()
	{
		$transaksi = $this->transaksi->orderby('tanggal','desc')->get();
		return view('transaksi.index',[
			'transaksi' => $transaksi
		]);
	}

	function tambah()
	{
		$request = request()->post();
		if($request)
		{
			$pelanggan = $this->pelanggan->save([
				'nama' => $request->nama
			]);

			$transaksi = $this->transaksi->save([
				'id_produk' => $request->id_produk,
				'id_pelanggan' => $pelanggan,
				'jumlah'       => $request->jumlah,
				'tanggal'      => date('Y-m-d H:i:s')
			]);

			$current_stok = $this->stok->where('id_produk',$request->id_produk)->orderby('tanggal','desc')->first();
			$sisa = 0;
			if(!empty($current_stok))
				$sisa = $current_stok->sisa;
			// $stok->save([
			// 	'jumlah' => $stok->jumlah - $request->jumlah
			// ]);
			$stok = $this->stok->save([
				'id_produk' => $request->id_produk,
				'jumlah' => $request->jumlah,
				'sisa'   => $sisa-$request->jumlah,
				'keterangan' => 'pengurangan stok',
				'tanggal' => date('Y-m-d H:i:s')
			]);

			$trend = Trend::where('bulan',date('m'))->where('tahun',date('Y'))->first();
			if(empty($trend))
			{
				$this->trend->save([
					'id_produk' => $request->id_produk,
					'bulan' => date('m'),
					'tahun' => date('Y'),
					'jumlah' => $request->jumlah
				]);
			}
			else
			{
				$trend->save([
					'id_produk' => $request->id_produk,
					'bulan' => date('m'),
					'tahun' => date('Y'),
					'jumlah' => $trend->jumlah+$request->jumlah
				]);
			}

			session()->set('success','Transaksi Berhasil di Simpan');
			redirect('/transaksi');
			return;
		}
		$produk = $this->produk->get();
		return view('transaksi.tambah',[
			'produk' => $produk
		]);
	}

	function edit($id)
	{
		$request = request()->post();
		$transaksi = $this->transaksi->find($id);
		if($request)
		{
			// $transaksi->jumlah = $request->jumlah;
			$transaksi->save([
				'id_produk' => $request->id_produk,
				'jumlah' => $request->jumlah
			]);

			session()->set('success','Transaksi Berhasil di edit');
			redirect('/transaksi');
			return;
		}
		$produk = $this->produk->get();
		return view('transaksi.edit',[
			'transaksi' => $transaksi,
			'produk' => $produk
		]);
	}

	function cetak($id)
	{
		$request = request()->post();
		$transaksi = $this->transaksi->find($id);
		return partial('transaksi.cetak',[
			'transaksi' => $transaksi
		]);
	}

	function hapus($id)
	{
		$this->transaksi->delete($id);
		session()->set('success','Transaksi Berhasil di hapus');
		redirect('/transaksi');
		return;
	}
}