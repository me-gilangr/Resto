<?php 

namespace App\Http\Config;

use App\Satuan;
use DataTables;
use Illuminate\Http\Request;

trait JsonDatatable
{
	public $pk;
	public $rawCols = ['action'];
	public $trashed = false;

	public function jsonGetData($model, $trashed)
	{
		$model = new $model;
		$this->pk = $model->getKeyName();
		if($trashed == 'true'){
			$model = $model->onlyTrashed();
			$this->trashed = true;
		} else {
			$this->trashed = false;
		}

		$a = $model->newQuery();
		$dataTables =  DataTables::eloquent($a);
		$dataTables->addColumn('action', function ($data) use($trashed) {
			return 'OK';
		}); 
		
		if (method_exists($this, '_button')) {
			$dataTables = $this->_button($dataTables, $trashed);
		} else {
			$dataTables->editColumn('action', function ($data) use($trashed) {
				if ($trashed == 'true') {
					$btn = $this->restoreBtn($data[$this->pk]);
				} else {
					$btn = $this->editBtn($data[$this->pk]).$this->delBtn($data[$this->pk]);
				}
				return '
					<div class="btn-group">
						'.$btn.'
					</div>
				';
			});
		}

		if (method_exists($this, '_dataColumn')){
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

	public function editBtn($id, $param1 = '', $param2 = '', $param3 = '')
	{
		return '<a href="#" class="btn btn-sm btn-info borad-0 edit" data-toggle="tooltip" wire:click="edit()" data-placement="top" title="Edit Data" data-original-title="Edit Data" data-id="'.$id.'" data-param1="'.$param1.'" data-param2="'.$param2.'" data-param3="'.$param3.'"> <i class="fa fa-edit"></i> </a>';
	}

	public function delBtn($id, $param1 = '', $param2 = '', $param3 = '')
	{
		return '<button type="submit" class="btn btn-sm borad-0 btn-danger hapus" data-id="'.$id.'" data-param1="'.$param1.'" data-param2="'.$param2.'" data-param3="'.$param3.'" style="border-radius: 0px;"><i class="fa fa-trash"></i> </button>';
	}

	public function restoreBtn($id, $param1 = '', $param2 = '', $param3 = '')
	{
		return '<button type="submit" class="btn btn-sm borad-0 btn-info restore" data-id="'.$id.'" data-param1="'.$param1.'" data-param2="'.$param2.'" data-param3="'.$param3.'" style="border-radius: 0px;"> <i class="fa fa-undo"></i> &ensp; Pulihkan Data </button> ';
	}
}
