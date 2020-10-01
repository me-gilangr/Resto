<?php

namespace App\Http\Controllers\Backend;

use App\Http\Config\JsonDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MejaController extends Controller
{
		use JsonDatatable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('backend.meja.index');
		}
		
		public function datatable(Request $request)
		{
			return $this->jsonGetData('App\Models\Meja', $request->trashed);
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

			$dataTables->editColumn('STATUS', function ($data) {
				$status = $data->STATUS;
				if ($status) {
					$status = '<small class="badge badge-primary"><i class="fa fa-check"></i> Aktif</small>';
				} else {
					$status = '<small class="badge badge-danger"><i class="fa fa-times"></i> Non-Aktif</small>';
				}

				return $status;
			});

			$this->rawColumns(['created_at', 'deleted_at', 'STATUS']);

			return $dataTables;
		}

		public function _button($dataTables, $trashed)
		{
			$dataTables->editColumn('action', function($data) use($trashed) {
				if ($trashed == 'true') {
					$add = '';
					$btn = $this->restoreBtn($data[$this->pk]);
				} else {
					if ($data['STATUS']) {
						$add = '
							<button class="btn btn-sm btn-dark borad-0 deactivate" data-toggle="tooltip" wire:click="deactivate()" data-placement="top" title="Non-Aktifkan" data-original-title="Edit Data" data-id="'.$data[$this->pk].'"> 
							<i class="fa fa-power-off"></i> 
							</button>
						';
					} else {
						$add = '
							<button class="btn btn-sm btn-success borad-0 activate" data-toggle="tooltip" wire:click="activate()" data-placement="top" title="Aktifkan" data-original-title="Edit Data" data-id="'.$data[$this->pk].'"> 
								<i class="fa fa-power-off"></i> 
							</button>
						';
					}
					
					$btn = $this->editBtn($data[$this->pk]).$this->delBtn($data[$this->pk]);
				}
				return '
					<div class="btn-group">
						'.$add.$btn.'
					</div>
				';
			});

			return $dataTables;
		}
}
