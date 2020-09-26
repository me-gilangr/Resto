<?php 

namespace App\Http\Config;

use App\Satuan;
use DataTables;
use Illuminate\Http\Request;

trait JsonDatatable
{
	public $pk;
	public $rawCols = ['action'];

	public function jsonGetData($model, $trashed)
	{
		$model = new $model;
		$this->pk = $model->getKeyName();
		if($trashed == 'true'){
			$model = $model->onlyTrashed();
		}

		$a = $model->newQuery();
		$dataTables =  DataTables::eloquent($a);
		$dataTables->addColumn('action', function ($data) use($trashed) {
				if ($trashed == 'true') {
					$btn = '
						<div class="btn-group">
							<button type="submit" class="btn btn-sm btn-info restore" data-id="'.$data[$this->pk].'" style="border-radius: 0px;">
								<i class="fa fa-undo"></i> &ensp; Pulihkan Data
							</button>
						</div>
					';
				} else {
					$btn = '
						<div class="btn-group">
							<a href="#" class="btn btn-sm btn-info edit" data-toggle="tooltip" wire:click="edit()" data-placement="top" title="Edit Data" data-original-title="Edit Data" data-id="'.$data[$this->pk].'">
									<i class="fa fa-edit"></i>
							</a>
							<button type="submit" class="btn btn-sm btn-danger hapus" data-id="'.$data[$this->pk].'" style="border-radius: 0px;">
								<i class="fa fa-trash"></i>
							</button>
						</div>
						';
				}
				return $btn;
			});

		
			if(method_exists($this, '_dataColumn')){
				$dataTables = $this->_dataColumn($dataTables);
			}
			$dataTables->rawColumns($this->rawCols);
		return $dataTables->addIndexColumn()->toJson();
	}

	public function rawColumns($rawCols)
	{
		foreach ($rawCols as $key => $value) {
			array_push($this->rawCols, $value);
		}
	}
}
