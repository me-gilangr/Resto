<?php

namespace App\Http\Controllers;

use App\Models\HeaderMenu;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function index()
	{
		$kategori = Kategori::get();
		$menu = HeaderMenu::get();
		// dd($menu[0]->detail[0]->produk->FNO_KATEGORI);
		return view('frontend.index', compact('kategori', 'menu'));
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
