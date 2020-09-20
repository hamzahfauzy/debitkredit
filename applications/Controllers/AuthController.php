<?php
namespace App\Controllers;
if (!defined('Z_MVC')) die ("Not Allowed");

use App\Models\User;

class AuthController
{
	function login()
	{
		if(session()->get('id'))
            redirect("/");

		return partial('auth.login');
	}

	function logout()
	{
		session()->destroy();
		redirect("/");
		return false;
	}

	function doLogin()
	{
		if(session()->get('id'))
            redirect("/");

		$request = request()->post();
		$user    = User::where('username',$request->username)->where('password',md5($request->password))->first();

		if(empty($user) || $user == null){
			session()->set('error','Username atau Password salah');
            session()->set('old_username',$request->username);
			redirect("/auth/login");
			die();
		}

		session()->set('id',$user->id);
		redirect("/");
		return false;
	}
}