<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Dapur\Pesanan;
use App\Models\PesananHeader;
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
		$pesanan = PesananHeader::get();
		return view('backend.pesanan.meja', compact('pesanan'));
	}
}
