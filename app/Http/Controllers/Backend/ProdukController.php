<?php

namespace App\Http\Controllers\Backend;

use App\Http\Config\JsonDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
	use JsonDatatable;

	public function index()
	{
		return view('backend.produk.index');
	}

	public function datatable(Request $request)
	{
		return $this->jsonGetData('App\Models\Produk', $request->trashed);
	}

	public function _dataColumn($dataTables)
	{
		$dataTables->addColumn('created_at', function ($data) {
			$date = '<u>'. date('d/m/Y H:i:s',strtotime($data->created_at)).'</u>';
			return $date;
		});

		$dataTables->addColumn('deleted_at', function ($data) {
			$date = '<u>'. date('d/m/Y H:i:s',strtotime($data->deleted_at)).'</u>';
			return $date;
		});

		$dataTables->editColumn('FNO_KATEGORI', function($data) {
			$kat = $data->kategori->FN_KATEGORI;
			return $kat;
		});

		$this->rawColumns(['created_at', 'deleted_at']);

		return $dataTables;
	}
}
