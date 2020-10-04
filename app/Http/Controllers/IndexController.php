<?php

namespace App\Http\Controllers;

use App\Models\HeaderMenu;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
	public function index()
	{
		$kategori = Kategori::get();

		// $menu = DB::table('t00_d_menu')
		// 	->join('t00_h_menu', 't00_d_menu.FNO_H_MENU', '=','t00_h_menu.FNO_H_MENU')
		// 	->join('t00_m_produk', 't00_d_menu.FNO_PRODUK', '=','t00_m_produk.FNO_PRODUK')
		// 	->join('t00_ref_produk', 't00_m_produk.FNO_KATEGORI', '=','t00_ref_produk.FNO_KATEGORI')
		// 	->select('t00_ref_produk.FN_KATEGORI', 't00_h_menu.FN_MENU', 't00_h_menu.FGAMBAR', 't00_h_menu.FHARGAJUAL')
		// 	->get();

		$menu = DB::select( DB::raw('
		SELECT
			d.FNO_KATEGORI,
			d.FN_KATEGORI,
			b.FN_MENU,
			b.FHARGAJUAL,
			b.FGAMBAR
		FROM t00_d_menu as a
		INNER JOIN t00_h_menu as b
		on a.FNO_H_MENU=b.FNO_H_MENU
		INNER JOIN t00_m_produk as c
		on c.FNO_PRODUK=a.FNO_PRODUK
		INNER JOIN t00_ref_produk as d
		on d.FNO_KATEGORI=c.FNO_KATEGORI
		WHERE b.deleted_at IS NULL
		GROUP BY d.FNO_KATEGORI, d.FN_KATEGORI,	b.FN_MENU,	b.FHARGAJUAL,	b.FGAMBAR') );
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
