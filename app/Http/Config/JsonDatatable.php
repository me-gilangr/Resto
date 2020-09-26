<?php

namespace App\Http\Controllers;

use App\Http\Config\JsonDatatable;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
		use JsonDatatable;

    public function index()
    {
      return view('satuan.index', compact('title'));
		}
		
		public function datatable(Request $request)
		{
			return $this->jsonGetData('App\Satuan', $request->trashed);
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
