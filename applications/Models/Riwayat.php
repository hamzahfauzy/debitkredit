<?php
namespace App\Models;
use Model;

class Riwayat extends Model
{
    static $table = "riwayat";

    function nasabah()
    {
        return $this->hasOne(Nasabah::class,['id'=>'nasabah_id']);
    }

    function pengguna()
    {
    	return $this->hasOne(pengguna::class,['id'=>'user_id']);
    }
}