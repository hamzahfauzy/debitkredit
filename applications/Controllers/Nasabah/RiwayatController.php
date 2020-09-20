<?php
namespace App\Controllers\Nasabah;
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
		$nasabah = $this->nasabah->where('user_id',session()->get('id'))->first();
		$riwayat = $this->riwayat->where('nasabah_id',$nasabah->id)->get();
		return view('nasabah.riwayat.index',[
			'riwayat' => $riwayat
		]);
	}
}