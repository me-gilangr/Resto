<?php

namespace App\Http\Livewire\Produk;

use App\Models\GroupPembuatan;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Form extends Component
{
	public $FNO_PRODUK = '';
	public $FNO_KATEGORI = '';
	public $FN_KATEGORI = '';
	public $FN_NAMA = '';
	public $DAPUR = null;
	public $BAR = null;	
	public $FTEMPAT = null;
	public $edit = false;
	public $err_area = '';

	protected $listeners = [
		'edit' => 'editing',
		'editFalse' => 'editFalse',
	];

	public function hydrate()
	{
		$this->resetErrorBag();
		$this->resetValidation();
		$this->err_area = '';
	}

	public function render()
	{
		$kategori = Kategori::get();
		return view('livewire.produk.form', compact('kategori'));
	}

	public function updatedFNOProduk($value)
	{
		$data = Validator::make(
			[
				'FNO_PRODUK' => $this->FNO_KATEGORI . $this->FNO_PRODUK,
			],
			[
				'FNO_PRODUK' => 'required|alpha_num|min:6|max:6|unique:t00_m_produk,FNO_PRODUK',
			],
			[
				'alpha_num' => 'Isi Harus Berupa Alphanumeric (A-Z, 0-9, a-z) !',
				'required' => 'Field Wajib di-Isi / Tidak Boleh Kosong !',
				'max' => 'Jumlah Huruf Tidak Boleh Lebih Dari :max Karakter',
				'min' => 'Jumlah Huruf Harus Berjumlah :min Karakter (Kode Kategori + Kode Produk)',
				'unique' => 'Data Sudah Ada !',
			]
		)->validate();

		return $data;
	}

	public function updatedFNOKategori($value)
	{
		$this->FNO_PRODUK = '';

		$data = Validator::make(
			[
				'FNO_KATEGORI' => $this->FNO_KATEGORI,
			],
			[
				'FNO_KATEGORI' => 'required|alpha_num|min:3|max:3|exists:t00_ref_produk,FNO_KATEGORI',
			],
			[
				'alpha_num' => 'Isi Harus Berupa Alphanumeric (A-Z, 0-9, a-z) !',
				'required' => 'Field Wajib di-Isi / Tidak Boleh Kosong !',
				'max' => 'Jumlah Huruf Tidak Boleh Lebih Dari :max Karakter',
				'min' => 'Jumlah Huruf Harus Berjumlah :min Karakter',
				'exists' => 'Data Tidak Ada !',
			]
		)->validate();

		return $data;
	}

	public function updatedFTEMPAT($value)
	{
		$data = Validator::make(
			[
				'FTEMPAT' => $this->FTEMPAT,
			],
			[
				'FNO_KATEGORI' => 'required|string|min:1|max:1',
			],
			[
				'alpha_num' => 'Isi Harus Berupa Alphanumeric (A-Z, 0-9, a-z) !',
				'required' => 'Field Wajib di-Isi / Tidak Boleh Kosong !',
				'max' => 'Jumlah Huruf Tidak Boleh Lebih Dari :max Karakter',
				'min' => 'Jumlah Huruf Harus Berjumlah :min Karakter',
				'exists' => 'Data Tidak Ada !',
			]
		)->validate();

		return $data;
	}

	public function updatedFNNama()
	{
		$data = Validator::make(
			[
				'FN_NAMA' => $this->FN_NAMA,
			],
			[
				'FN_NAMA' => 'required|string|max:50',
			],
			[
				'string' => 'Isi Harus Berupa String (A-Z, 0-9, a-z) !',
				'required' => 'Field Wajib di-Isi / Tidak Boleh Kosong !',
				'max' => 'Jumlah Huruf Tidak Boleh Lebih Dari :max Karakter',
				'unique' => 'Data Sudah Ada !',
			]
		)->validate();

		return $data;
	}

	public function valArea()
	{
		$next = false;
		if ($this->DAPUR == null && $this->BAR == null) {
			if ($this->DAPUR == false && $this->BAR == false) {
				$this->err_area = 'Silahkan Pilih Lokasi Pembuatan !';
			} else {
				$next = true;
			}
		} else {
			$next = true;
		} 

		return $next;
	}

	public function tambah()
	{
		// $next = $this->valArea();
		$next = true;
		if ($next == true) {
			$data = $this->validating();
			try {
				DB::beginTransaction();
				$simpan = Produk::firstOrCreate($data);

				// if ($this->DAPUR != null && $this->DAPUR != false) {
				// 	$group = GroupPembuatan::firstOrCreate([
				// 		'FNO_PRODUK' => $data['FNO_PRODUK'],
				// 		'FTEMPAT' => $this->DAPUR,
				// 	]);
				// }
				
				// if ($this->BAR != null && $this->BAR != false) {
				// 	$group = GroupPembuatan::firstOrCreate([
				// 		'FNO_PRODUK' => $data['FNO_PRODUK'],
				// 		'FTEMPAT' => $this->BAR,
				// 	]);
				// }
	
				DB::commit();
	
				$this->clear();
				$this->emit('tutupModal');
				$this->emit('updatedDataTable');
				$this->emit('success', 'Berhasil Menambahkan Data !');	
			} catch (\Exception $e) {
				DB::rollBack();
				$this->emit('error', 'Terjadi Kesalahan !');
			}
		}
	}

	public function validating()
	{
		$data = Validator::make(
			[
				'FNO_PRODUK' => $this->FNO_KATEGORI . $this->FNO_PRODUK,
				'FNO_KATEGORI' => $this->FNO_KATEGORI,
				'FN_NAMA' => $this->FN_NAMA,
				'FTEMPAT' => $this->FTEMPAT,
			],
			[
				'FNO_PRODUK' => 'required|string|min:6|max:6|unique:t00_m_produk,FNO_PRODUK',
				'FNO_KATEGORI' => 'required|alpha_num|min:3|max:3|exists:t00_ref_produk,FNO_KATEGORI',
				'FN_NAMA' => 'required|string|max:50',
				'FTEMPAT' => 'required|string|max:1|min:1',
			],
			[
				'string' => 'Isi Harus Berupa Alphanumeric (A-Z, 0-9, a-z) !',
				'required' => 'Field Wajib di-Isi / Tidak Boleh Kosong !',
				'max' => 'Jumlah Huruf Tidak Boleh Lebih Dari :max Karakter',
				'min' => 'Jumlah Huruf Harus Berjumlah :min Karakter',
				'unique' => 'Data Sudah Ada !',
				'exists' => 'Data Tidak Ada !',
			]
		)->validate();

		return $data;
	}

	public function editing($id)
	{
		try {
			$this->edit = false;
			$produk = Produk::findOrFail($id);
			$this->edit = $produk;
			$this->emit('bukaModal');
			$this->FNO_PRODUK = substr($produk->FNO_PRODUK, 3, 3);
			$this->FNO_KATEGORI = $produk->FNO_KATEGORI;
			$this->FN_KATEGORI = $produk->kategori->FN_KATEGORI;
			$this->FN_NAMA = $produk->FN_NAMA;
			$this->FTEMPAT = $produk->FTEMPAT;

			// $group = $produk->groupBuat->pluck('FTEMPAT')->toArray();
			// if (in_array("D", $group)) {
			// 	$this->DAPUR = "D";
			// }

			// if (in_array("B", $group)) {
			// 	$this->BAR = "B";
			// }
			
		} catch (\Exception $e) {
			$edit = false;
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function updateData($kode)
	{
		// $next = $this->valArea();
		$next = true;
		if ($next == true) {
			try {
				DB::beginTransaction();
				$produk = Produk::findOrFail($kode);
				$produk->update([
					'FN_NAMA' => $this->FN_NAMA,
					'FTEMPAT' => $this->FTEMPAT,
				]);

				// if ($this->DAPUR != null && $this->DAPUR != false) {
				// 	$group = GroupPembuatan::firstOrCreate([
				// 		'FNO_PRODUK' => $produk->FNO_PRODUK,
				// 		'FTEMPAT' => $this->DAPUR,
				// 	]);
				// } else {
				// 	$group = GroupPembuatan::where('FNO_PRODUK', '=', $produk->FNO_PRODUK)->where('FTEMPAT', '=', 'D')->delete();
				// }
				
				// if ($this->BAR != null && $this->BAR != false) {
				// 	$group = GroupPembuatan::firstOrCreate([
				// 		'FNO_PRODUK' => $produk->FNO_PRODUK,
				// 		'FTEMPAT' => $this->BAR,
				// 	]);
				// } else {
				// 	$group = GroupPembuatan::where('FNO_PRODUK', '=', $produk->FNO_PRODUK)->where('FTEMPAT', '=', 'B')->delete();
				// }

				DB::commit();

				$this->clear();
				$this->emit('tutupModal');
				$this->emit('updatedDataTable');
				$this->emit('info', 'Data di-Ubah !');
			} catch (\Exception $e) {
				DB::rollBack();
				$this->emit('error', 'Terjadi Kesalahan !');
				dd($e);
			}
		}
	}

	public function clear()
	{
		$this->edit = false;
		$this->FNO_PRODUK = '';
		$this->FNO_KATEGORI = '';
		$this->FN_KATEGORI = '';
		$this->FN_NAMA = '';
		$this->DAPUR = null;
		$this->BAR = null;
	}

	public function editFalse()
	{
		$this->clear();
	}

	public function updatingBAR()
	{
		$this->DAPUR = false;
	}
}
