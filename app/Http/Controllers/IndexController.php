<?php

namespace App\Http\Controllers;

use App\Models\HeaderMenu;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ShoppingCart;

class IndexController extends Controller
{
	public function index()
	{
		$kategori = Kategori::get();

		// $menu = DB::select( DB::raw('
		// SELECT
		// 	d.FNO_KATEGORI,
		// 	d.FN_KATEGORI,
		// 	b.FN_MENU,
		// 	b.FHARGAJUAL,
		// 	b.FGAMBAR
		// FROM t00_h_menu as a
		// INNER JOIN t00_h_menu as b
		// on a.FNO_H_MENU=b.FNO_H_MENU
		// INNER JOIN t00_m_produk as c
		// on c.FNO_PRODUK=a.FNO_PRODUK
		// INNER JOIN t00_ref_produk as d
		// on d.FNO_KATEGORI=c.FNO_KATEGORI
		// WHERE b.deleted_at IS NULL
		// GROUP BY d.FNO_KATEGORI, d.FN_KATEGORI,	b.FN_MENU,	b.FHARGAJUAL,	b.FGAMBAR') );

		$menu = HeaderMenu::where('FSTATUS', '=', 1)->get();
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

	public function cartData(Request $request)
	{
		try {
			$cart = ShoppingCart::session($request->id)->getContent()->toArray();
			return response()->json($cart, 200);
		} catch (\Exception $e) {
			return response()->json($e, 200);
		}
	}
}
