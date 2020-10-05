<?php

namespace App\Http\Livewire\Produk;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Form extends Component
{
	public $FNO_PRODUK = '';
	public $FNO_KATEGORI = '';
	public $FN_KATEGORI = '';
	public $FN_NAMA = '';
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
				'FNO_PRODUK' => 'required|alpha_num|min:5|max:5|unique:t00_m_produk,FNO_PRODUK',
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
		$data = Validator::make(
			[
				'FNO_KATEGORI' => $this->FNO_KATEGORI,
			],
			[
				'FNO_KATEGORI' => 'required|alpha_num|min:2|max:2|exists:t00_ref_produk,FNO_KATEGORI',
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

	public function tambah()
	{
		$data = $this->validating();

		try {
			$simpan = Produk::firstOrCreate($data);

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
				'FNO_PRODUK' => $this->FNO_KATEGORI . $this->FNO_PRODUK,
				'FNO_KATEGORI' => $this->FNO_KATEGORI,
				'FN_NAMA' => $this->FN_NAMA,
			],
			[
				'FNO_PRODUK' => 'required|string|min:5|max:5|unique:t00_m_produk,FNO_PRODUK',
				'FNO_KATEGORI' => 'required|alpha_num|min:2|max:2|exists:t00_ref_produk,FNO_KATEGORI',
				'FN_NAMA' => 'required|string|max:50',
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
			$this->FNO_PRODUK = substr($produk->FNO_PRODUK, 2, 3);
			$this->FNO_KATEGORI = $produk->FNO_KATEGORI;
			$this->FN_KATEGORI = $produk->kategori->FN_KATEGORI;
			$this->FN_NAMA = $produk->FN_NAMA;
		} catch (\Exception $e) {
			$edit = false;
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function updateData($kode)
	{
		try {
			$produk = Produk::findOrFail($kode);
			$produk->update([
				'FNO_PRODUK' => $this->FNO_KATEGORI . $this->FNO_PRODUK,
				'FNO_KATEGORI' => $this->FNO_KATEGORI,
				'FN_NAMA' => $this->FN_NAMA,
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
		$this->FNO_PRODUK = '';
		$this->FNO_KATEGORI = '';
		$this->FN_KATEGORI = '';
		$this->FN_NAMA = '';
	}

	public function editFalse()
	{
		$this->clear();
	}

}
