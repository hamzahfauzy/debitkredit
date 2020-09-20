<?php
namespace App\Controllers\Nasabah;

use App\Models\Nasabah;

class IndexController {

	function index()
	{
		$nasabah = Nasabah::where('user_id',session()->get('id'))->first();
		return view('nasabah.home.detail',[
			'nasabah' => $nasabah
		]);
	}
}