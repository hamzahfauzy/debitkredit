<?php
namespace App\Controllers;
if (!defined('Z_MVC')) die ("Not Allowed");

use App\Helpers\AdminMiddleware;

class HomeController
{
	function __construct()
	{
		// new AdminMiddleware;
	}

	function index()
	{
		if(!session()->get('id'))
		{
			redirect('/auth/login');
			return;
		}
		return view("home.index");
	}
}