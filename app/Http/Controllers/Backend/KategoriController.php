<?php

namespace App\Http\Controllers\Backend;

use App\Http\Config\JsonDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
		use JsonDatatable;

		public function index()
    {
      return view('backend.kategori.index');
		}
		
		public function datatable(Request $request)
		{
			return $this->jsonGetData('App\Models\Kategori', $request->trashed);
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

		public function _button($dataTables, $trashed)
		{
			$dataTables->editColumn('action', function($data) use($trashed) {
				if ($trashed == 'true') {
					$add = '';
					$btn = $this->restoreBtn($data[$this->pk], $data->FK_GROUP);
				} else {
					$add = '';
					$btn = $this->editBtn($data[$this->pk], $data->FK_GROUP) . $this->delBtn($data[$this->pk], $data->FK_GROUP); 
				}
				return '
					<div class="btn-group">
						'.$btn.'
					</div>
				';
			});

			return $dataTables;
		}
}
