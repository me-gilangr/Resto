<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Dapur\Pesanan;
use App\Models\Meja;
use App\Models\PesananHeader;
use App\Models\PesananMeja;
use Illuminate\Http\Request;

class PesananController extends Controller
{
	public function index()
	{
		$pesanan = PesananHeader::get();
		return view('backend.pesanan.index', compact('pesanan'));
	}
	
	public function meja()
	{
		$pesanan = PesananMeja::with('header')->with('meja')->get()->groupBy('FNO_H_PESAN');
		$meja = Meja::with('pesanan')->get();
		// dd(count($pesanan[201019003][0]->header->detail));
		return view('backend.pesanan.meja', compact('meja', 'pesanan'));
	}
}
