<?php namespace App\Controllers;
 
// Home Controller
// Author: Sistiandy <sistiandy.syahbana@gmail.com>

// This item controller as a dashboard
// Show summary from modules

// This project layout is a little bit messy, but this behaviour comes
// from the ancestor and this inherited from ancient world.

class Home extends BaseController
{
	public function index()
	{
        $data['title'] = "Dashboard";
		return view('dashboard', $data);
	}

}
