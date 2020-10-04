<?php

namespace App\Http\Controllers\Backend;

use App\Http\Config\JsonDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KodeGroupController extends Controller
{
	use JsonDatatable;

	public function index()
	{
		return view('backend.kodeGroup.index');
	}
	
	public function datatable(Request $request)
	{
		return $this->jsonGetData('App\Models\KodeGroup', $request->trashed);
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

		$this->rawColumns(['created_at', 'deleted_at']);

		return $dataTables;
	}
}
