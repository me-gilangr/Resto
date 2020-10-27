<?php

namespace App\Http\Controllers\Backend;

use App\Http\Config\JsonDatatable;
use App\Http\Controllers\Controller;
use App\Models\PesananHeader;
use Illuminate\Http\Request;

class KasirController extends Controller
{
	use JsonDatatable;

	public function index()
	{
		return view('backend.kasir.index');
	}

	public function bayar($id)
	{
		try {
			$pesanan = PesananHeader::findOrFail($id);
			return view('backend.kasir.bayar', compact('pesanan'));
		} catch (\Exception $e) {
			session()->flash('error', 'Terjadi Kesalahan !');
			return redirect()->back();
		}
	}

	public function datatable(Request $request)
	{
		return $this->jsonGetData('App\Models\PesananHeader', $request->trashed);
	}

	public function _dataColumn($dataTables)
		{
			$dataTables->addColumn('TGL_PESAN', function ($data) {
				$date = '<u>'. date('d/m/Y',strtotime($data->TGL_PESAN)).'</u>';
				return $date;
			});

			$dataTables->addColumn('MEJA', function ($data) {
				$meja = null;
				$list = null;
				$count = count($data->meja);
				$cm = 0;
				foreach ($data->meja as $item) {
					$cm += 1;
					$list .= $item->FNO_MEJA ;
					$cm != $count ? $list .=', ': $list .=''; 
				}

				$meja = $list;

				return $meja;
			});

			$dataTables->addColumn('MENU', function ($data) {
				$menu = count($data->detail) . ' Menu';
				return $menu;
			});
			
			$dataTables->addColumn('TOTAL', function ($data) {
				$total = '<b> Rp. '. number_format($data->detail->sum('FHARGA'), 0, ',', '.') . '</b>';
				return $total;
			});

			$this->rawColumns(['TGL_PESAN', 'MEJA', 'MENU', 'TOTAL']);

			return $dataTables;
		}

		public function _button($dataTables, $trashed)
		{
			$dataTables->editColumn('action', function($data) use($trashed) {
				if ($trashed == 'true') {
					$add = '';
					// $btn = $this->restoreBtn($data[$this->pk], $data->FK_GROUP);
					$btn = '';
				} else {
					$add = '';
					// $btn = $this->editBtn($data[$this->pk], $data->FK_GROUP) . $this->delBtn($data[$this->pk], $data->FK_GROUP); 
					$btn = '
					<a href="'.route('backend.kasir.bayar', $data->FNO_H_PESAN).'" class="btn btn-info btn-sm">
						<i class="fa fa-arrow-right"></i> &ensp; Bayar
					</a>
					';
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
