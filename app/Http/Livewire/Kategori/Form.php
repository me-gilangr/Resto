<?php

namespace App\Http\Livewire\Kategori;

use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Form extends Component
{
	public $FNO_KATEGORI = '';
	public $FN_KATEGORI = '';
	public $edit = false;

	protected $listeners = [
		'edit' => 'editing',
		'editFalse' => 'editFalse',
	];

	public function hydrate()
	{
		$this->resetErrorBag();
		$this->resetValidation();
	}

	public function render()
	{
		return view('livewire.kategori.form');
	}

	public function updatedFNOKategori($value)
	{
		$data = Validator::make(
			[
				'FNO_KATEGORI' => $this->FNO_KATEGORI,
			],
			[
				'FNO_KATEGORI' => 'required|alpha_num|max:2|unique:t00_ref_produk,FNO_KATEGORI',
			],
			[
				'alpha_num' => 'Isi Harus Berupa Alphanumeric (A-Z, 0-9, a-z) !',
				'required' => 'Field Wajib di-Isi / Tidak Boleh Kosong !',
				'max' => 'Jumlah Huruf Tidak Boleh Lebih Dari :max Karakter',
				'unique' => 'Data Sudah Ada !',
			]
		)->validate();

		return $data;
	}

	public function updatedFJENIS()
	{
		$data = Validator::make(
			[
				'FN_KATEGORI' => $this->FN_KATEGORI,
			],
			[
				'FN_KATEGORI' => 'required|string|max:20',
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

	public function tambah()
	{
		$data = $this->validating();

		try {
			$simpan = Kategori::firstOrCreate($data);

			$this->clear();
			$this->emit('tutupModal');
			$this->emit('updatedDataTable');
			$this->emit('success', 'Berhasil Menambahkan Data !');	
		} catch (\Exception $e) {
			dd($e);
		}
	}

	public function validating()
	{
		$data = Validator::make(
			[
				'FNO_KATEGORI' => $this->FNO_KATEGORI,
				'FN_KATEGORI' => $this->FN_KATEGORI,
			],
			[
				'FNO_KATEGORI' => 'required|string|max:2|unique:t00_ref_produk,FNO_KATEGORI',
				'FN_KATEGORI' => 'required|string|max:20',
			],
			[
				'string' => 'Isi Harus Berupa Alphanumeric (A-Z, 0-9, a-z) !',
				'required' => 'Field Wajib di-Isi / Tidak Boleh Kosong !',
				'max' => 'Jumlah Huruf Tidak Boleh Lebih Dari :max Karakter',
				'unique' => 'Data Sudah Ada !',
			]
		)->validate();

		return $data;
	}

	public function editing($id)
	{
		try {
			$this->edit = false;
			$kategori = Kategori::findOrFail($id);
			$this->edit = $kategori;
			$this->emit('bukaModal');
			$this->FNO_KATEGORI = $kategori->FNO_KATEGORI;
			$this->FN_KATEGORI = $kategori->FN_KATEGORI;
		} catch (\Exception $e) {
			$edit = false;
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function updateData($kode)
	{
		try {
			$kategori = Kategori::findOrFail($kode);
			$kategori->update([
				'FN_KATEGORI' => $this->FN_KATEGORI,
			]);

			$this->clear();
			$this->emit('tutupModal');
			$this->emit('updatedDataTable');
			$this->emit('info', 'Data di-Ubah !');
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function clear()
	{
		$this->edit = false;
		$this->FNO_KATEGORI = '';
		$this->FN_KATEGORI = '';
	}

	public function editFalse()
	{
		$this->clear();
	}
}
