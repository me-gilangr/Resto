<?php

namespace App\Http\Controllers\Backend;

use App\Http\Config\JsonDatatable;
use App\Http\Controllers\Controller;
use App\Models\DetailMenu;
use App\Models\HeaderMenu;
use App\Models\Kategori;
use App\Models\KodeGroup;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
	public $name = '';
	use JsonDatatable;

	public function index()
	{
		return view('backend.menu.index');
	}

	public function create()
	{
		$produk = Produk::orderBy('FN_NAMA', 'ASC')->get();
		return view('backend.menu.create', compact('produk', 'kodeGroup'));
	}

	public function store(Request $request)
	{
		Validator::make(
			[
				'FNO_KATEGORI' => $request->FNO_KATEGORI . $request->FNO_H_MENU,
			],
			[
				'FNO_KATEGORI' => 'required|alpha_num|min:5|max:5|unique:t00_h_menu,FNO_H_MENU',
			],
			[
				'alpha_num' => 'Isi Harus Berupa Alphanumeric (A-Z, 0-9, a-z) !',
				'required' => 'Field Wajib di-Isi / Tidak Boleh Kosong !',
				'max' => 'Jumlah Huruf Tidak Boleh Lebih Dari :max Karakter (Kategori + Kode Menu)',
				'min' => 'Jumlah Huruf Harus Berjumlah :min Karakter (Kategori + Kode Menu)',
				'exists' => 'Data Tidak Ada !',
			]
		)->validate();

		$this->validate($request, [
			'FK_GROUP' => 'required|string|max:1|min:1|exists:t00_ref_kategori,FK_GROUP',
			'FNO_KATEGORI' => 'required|string|max:3|min:3|exists:t00_ref_produk,FNO_KATEGORI',
			'FN_MENU' => 'required|string|max:50',
			'FHARGAPOKOK' => 'required|numeric|min:1',
			// 'FMARGIN' => 'required|numeric|min:1',
			// 'FPAJAK' => 'required|numeric|between:0,99.99',
			'produk' => 'required|array',
			'produk.*' => 'exists:t00_m_produk,FNO_PRODUK',
			'FGAMBAR' => 'required|image|mimes:jpg,jpeg,png',
		], [
			'required' => 'Field Tidak Boleh Kosong !',
			'numeric' => 'Inputan Harus Berupa Angka !',
			'mimes' => 'Format Gambar Harus Berupa :mimes !',
			'image' => 'Upload Harus Berupa Gambar !',
			'string' => 'Inputan Harus Berupa Alphanumerik !',
			'max' => 'Maksimal Karakter :max !',
			'between' => 'Nominal Harus di-Antara :between',
		]);

		try {
			$this->name = '';

			if ($request->hasFile('FGAMBAR')) {
				$name = time() . rand(10, 99) . '.' . $request->file('FGAMBAR')->getClientOriginalExtension();
				$this->name = $name;
				$request->file('FGAMBAR')->storeAs('Menu', $name, 'images');
			}

			DB::beginTransaction();
			
			// $date = date('Ym');
			// $date = substr($date, 2, 4);
			// $kode = HeaderMenu::withTrashed()->where('FNO_H_MENU','like',$date.'%')->get();
			// if (count($kode) > 0) {
			// 	$array = count($kode) - 1;
			// 	$data = $kode[$array]->FNO_H_MENU;
			// 	$hapus = (int) substr($data,4,3);
			// 	$hapus++;
			// 	$kodemenu = $date . sprintf("%03s", $hapus);
			// }else{
			// 	$kodemenu = $date.'001';
			// }

			// $hargaMargin = ($request->FHARGAPOKOK * $request->FMARGIN);
			// $pajak = ($hargaMargin * $request->FPAJAK);
			// $hargaJual = $hargaMargin + $pajak;

			$header = HeaderMenu::firstOrCreate([
				'FNO_H_MENU' => $request->FNO_KATEGORI . $request->FNO_H_MENU,
				'FN_MENU' => $request->FN_MENU,
				'FHARGAPOKOK' => $request->FHARGAPOKOK,
				// 'FMARGIN' => $request->FMARGIN,
				// 'FPAJAK' => $request->FPAJAK,
				'FHARGAJUAL' => $request->FHARGAJUAL,
				'FGAMBAR' => $name,
			]);

			foreach ($request->produk as $item) {
				$detail = DetailMenu::create([
					'FNO_H_MENU' => $request->FNO_KATEGORI . $request->FNO_H_MENU,
					'FNO_PRODUK' => $item,
				]);
			}

			DB::commit();

			$this->name = '';
			session()->flash('success', 'Data Menu di-Tambahkan !');
			return redirect(route('menu.index'));

		} catch (\Exception $e) {
			DB::rollback();
			Storage::disk('images')->delete('Menu/' . $this->name);
			dd($e);
			session()->flash('error', 'Terjadi Kesalahan !');
			return redirect()->back()->withInput($request->all());
		}
	}
	
	public function edit($id)
	{
		try {
			$produk = Produk::get();
			$edit = HeaderMenu::findOrFail($id);
			return view('backend.menu.edit', compact('edit', 'produk'));
		} catch (\Exception $e) {
			dd($e);
			session()->flash('error', 'Terjadi Kesalahan !');
			return redirect()->back();
		}
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'FN_MENU' => 'required|string|max:50',
			'FHARGAPOKOK' => 'required|numeric|min:1',
			// 'FMARGIN' => 'required|numeric|min:1',
			// 'FPAJAK' => 'required|numeric|between:0,99.99',
			'produk' => 'required|array',
			'produk.*' => 'exists:t00_m_produk,FNO_PRODUK',
			'FGAMBAR' => 'nullable|image|mimes:jpeg,jpg,png',
		], [
			'required' => 'Field Tidak Boleh Kosong !',
			'numeric' => 'Inputan Harus Berupa Angka !',
			'mimes' => 'Format Gambar Harus Berupa .jpg, .jpeg, .png !',
			'image' => 'Upload Harus Berupa Gambar !',
			'string' => 'Inputan Harus Berupa Alphanumerik !',
			'max' => 'Maksimal Karakter :max !',
			'between' => 'Nominal Harus di-Antara :between',
		]);

		try {
			$menu = HeaderMenu::findOrFail($id);

			DB::beginTransaction();

			$name = $menu->FGAMBAR;
			$oldImg = $menu->FGAMBAR;
			if (isset($request->FGAMBAR) && $request->FGAMBAR !== '') {
				if ($request->hasFile('FGAMBAR')) {
					$name = time() . rand(10, 99) . '.' . $request->file('FGAMBAR')->getClientOriginalExtension();
					$this->name = $name;
					$request->file('FGAMBAR')->storeAs('Menu', $name, 'images');
				}
			}


			// $hargaMargin = ($request->FHARGAPOKOK * $request->FMARGIN);
			// $pajak = ($hargaMargin * $request->FPAJAK);
			// $hargaJual = $hargaMargin + $pajak;

			$menu->update([
				'FN_MENU' => $request->FN_MENU,
				'FHARGAPOKOK' => $request->FHARGAPOKOK,
				// 'FMARGIN' => $request->FMARGIN,
				// 'FPAJAK' => $request->FPAJAK,
				'FHARGAJUAL' => $request->FHARGAJUAL,
				'FGAMBAR' => $name,
			]);

			$menu->detail()->delete();
			
			foreach ($request->produk as $item) {
				$detail = DetailMenu::create([
					'FNO_H_MENU' => $id,
					'FNO_PRODUK' => $item,
				]);
			}

			DB::commit();
			if (isset($request->FGAMBAR) && $request->FGAMBAR !== '') {
				Storage::disk('images')->delete('Menu/' . $oldImg);
			}

			$this->name = '';
			session()->flash('error', 'Data Berhasil di-Ubah !');
			return redirect(route('menu.index'));
		} catch (\Exception $e) {
			DB::rollback();
			Storage::disk('images')->delete('Menu/' . $this->name);
			session()->flash('error', 'Terjadi Kesalahan !');
			return redirect()->back();
		}

	}

	public function datatable(Request $request)
	{
		return $this->jsonGetData('App\Models\HeaderMenu', $request->trashed);
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

		$dataTables->editColumn('FHARGAPOKOK', function($data) {
			return 'Rp. ' . number_format($data->FHARGAPOKOK, 0, ',', '.');
		});

		$dataTables->editColumn('FMARGIN', function($data) {
			$margin = ($data->FHARGAPOKOK * $data->FMARGIN);
			return 'Rp. ' . number_format($margin, 0, ',', '.');
		});
		
		$dataTables->editColumn('FPAJAK', function($data) {
			// $hitungMargin = ($data->FHARGAPOKOK * $data->FMARGIN);
			$pajak = ($data->FHARGAJUAL * $data->FPAJAK);
			return 'Rp. ' . number_format($pajak, 0, ',', '.');
		});

		$dataTables->editColumn('FHARGAJUAL', function($data) {
			// $hitungMargin = ($data->FHARGAPOKOK * $data->FMARGIN);
			// $pajak = ($hitungMargin * $data->FPAJAK);
			// $jual = $hitungMargin + $pajak;
			return 'Rp. ' . number_format($data->FHARGAJUAL, 0, ',', '.');
		});


		$dataTables->editColumn('FSTATUS', function ($data) {
			$status = $data->FSTATUS;
			if ($status) {
				$status = '<small class="badge badge-primary"><i class="fa fa-check"></i> Aktif</small>';
			} else {
				$status = '<small class="badge badge-danger"><i class="fa fa-times"></i> Non-Aktif</small>';
			}

			return $status;
		});

		$this->rawColumns(['created_at', 'deleted_at', 'FSTATUS']);

		return $dataTables;
	}

	public function _button($dataTables, $trashed)
	{
		$dataTables->editColumn('action', function($data) use($trashed) {
			if ($trashed == 'true') {
				$add = '';
				$btn = $this->restoreBtn($data[$this->pk]);
			} else {
				if ($data['FSTATUS']) {
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
				
				$btn = '<a href="'.route('menu.edit', $data['FNO_H_MENU']).'" class="btn btn-sm btn-info borad-0 edit" data-toggle="tooltip" data-placement="top" title="Edit Data" data-original-title="Edit Data"> <i class="fa fa-edit"></i> </a>'.$this->delBtn($data[$this->pk]);
			}
			return '
				<div class="btn-group">
					'.$add.$btn.'
				</div>
			';
		});

		return $dataTables;
	}

	public function kategori(Request $request)
	{
		$this->validate($request, [
			'FK_GROUP' => 'required|string'
		]);

		try {
			$kategori = Kategori::where('FK_GROUP', '=', $request->FK_GROUP)->get();
			return response()->json($kategori);
		} catch (\Exception $e) {
			return response()->json([
				'alert' => 'error',
				'message' => 'Terjadi Kesalahan !'
			], 200);
		}
	}
}

