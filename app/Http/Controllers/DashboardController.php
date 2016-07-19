<?php

namespace Invoicing\Http\Controllers;

class DashboardController extends Controller {

	public function __construct()
	{
        //
	}
	
	public function index()
	{
		return view('dashboard.index');
	}
	
}