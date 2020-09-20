<?php
namespace App\Models;
use Model;

class Nasabah extends Model
{
    static $table = "nasabah";

    function user()
    {
    	return $this->hasOne(User::class,['id'=>'user_id']);
    }

    function debet()
    {
    	$model = Riwayat::where('nasabah_id',$this->id)->where('tipe',1)->get();
    	$total = 0;
    	$tanggal = "";
    	foreach($model as $m)
    	{
    		$total+=$m->jumlah;
    		$tanggal = $m->tanggal;
    	}
    	return [
    		'total'=>$total,
    		'tanggal'=>$tanggal
    	];
    }

    function kredit()
    {
    	$model = Riwayat::where('nasabah_id',$this->id)->where('tipe',2)->get();
    	$total = 0;
    	$tanggal = "";
    	foreach($model as $m)
    	{
    		$total+=$m->jumlah;
    		$tanggal = $m->tanggal;
    	}
    	return [
    		'total'=>$total,
    		'tanggal'=>$tanggal
    	];
    }

    function sisa()
    {
    	$kredit = $this->kredit()['total'];
    	$debet = $this->debet()['total'];
    	return $kredit-$debet;
    }
}