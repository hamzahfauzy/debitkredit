<?php
namespace App\Models;
use Model;

class User extends Model
{
    static $table = "pengguna";
    protected $password;
    
    function getPassword()
    {
        return $this->password;
    }

    function setPassword($password)
    {
        $this->password = md5($password);
    }

}