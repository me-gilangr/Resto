<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
      return view('backend.index');
    }

    public function dataPesanan()
    {
      return view('backend.data-pesanan');
    }

    public function transaksiMeja()
    {
      return view('backend.transaksi-meja');
    }
}
