<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function index()
	{
		return view('welcome');
	}

	public function welcome(Request $request)
	{
		if (isset($request->meja) && $request->meja != null){
			$qr = "Meja Anda Saat Ini <br> Meja : ".$request->meja;
		} else {
			$qr = "Silahkan Scan Ulang QR"; 
		}
		return view('welcome', compact('qr'));
	}
}
