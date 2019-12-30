<?php

namespace Jybtx\Backstaged\Http\Controllers;
use Jybtx\Backstaged\Http\Controllers\Controller;
class HomeController extends Controller
{
	
	public function index()
	{
		dd( auth('admin')->user()->username );
	}
}