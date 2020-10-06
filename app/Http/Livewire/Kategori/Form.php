<?php

namespace App\Http\Livewire\Kategori;

use App\Models\Kategori;
use App\Models\KodeGroup;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends Component
{
	public $FNO_KATEGORI = '';
	public $FK_GROUP = '';
	public $FN_GROUP = '';
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
		$group = KodeGroup::get();
		return view('livewire.kategori.form', compact('group'));
	}

	public function updatedFNOKategori($value)
	{
		$FK_GROUP = $this->FK_GROUP;
		$FNO_KATEGORI = $this->FNO_KATEGORI;
		$data = Validator::make(
			[
				'FNO_KATEGORI' => $this->FNO_KATEGORI,
			],
			[
				'FNO_KATEGORI' => [
					'required',
					'alpha_num',
					'min:2',
					'max:2', 
					Rule::unique('t00_ref_produk')->where(function($query) use($FK_GROUP, $FNO_KATEGORI) {
						return $query->where('FNO_KATEGORI', $FNO_KATEGORI)->where('FK_GROUP', $FK_GROUP);
					}),
				],
			],
			[
				'alpha_num' => 'Isi Harus Berupa Alphanumeric (A-Z, 0-9, a-z) !',
				'required' => 'Field Wajib di-Isi / Tidak Boleh Kosong !',
				'max' => 'Jumlah Huruf Tidak Boleh Lebih Dari :max Karakter',
				'min' => 'Jumlah Huruf Harus Berjumlah :min Karakter',
				'unique' => 'Data Sudah Ada !',
			]
		)->validate();

		return $data;
	}

	public function updatedFKGroup($value)
	{
		$this->FNO_KATEGORI = '';
		$data = Validator::make(
			[
				'FK_GROUP' => $this->FK_GROUP,
			],
			[
				'FK_GROUP' => 'required|alpha_num|min:1|max:1|exists:t00_ref_kategori,FK_GROUP',
			],
			[
				'alpha_num' => 'Isi Harus Berupa Alphanumeric (A-Z, 0-9, a-z) !',
				'required' => 'Field Wajib di-Isi / Tidak Boleh Kosong !',
				'max' => 'Jumlah Huruf Tidak Boleh Lebih Dari :max Karakter',
				'min' => 'Jumlah Huruf Harus Berjumlah :min Karakter',
				'unique' => 'Data Sudah Ada !',
				'exists' => 'Data Tidak Ada !',
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
		$FK_GROUP = $this->FK_GROUP;
		$FNO_KATEGORI = $this->FNO_KATEGORI;

		$data = Validator::make(
			[
				'FNO_KATEGORI' => $this->FNO_KATEGORI,
				'FK_GROUP' => $this->FK_GROUP,
				'FN_KATEGORI' => $this->FN_KATEGORI,
			],
			[
				'FNO_KATEGORI' => [
					'required',
					'alpha_num',
					'min:2',
					'max:2', 
					Rule::unique('t00_ref_produk')->where(function($query) use($FK_GROUP, $FNO_KATEGORI) {
						return $query->where('FNO_KATEGORI', $FNO_KATEGORI)->where('FK_GROUP', $FK_GROUP);
					}),
				],
				'FK_GROUP' => 'required|alpha_num|min:1|max:1|exists:t00_ref_kategori,FK_GROUP',
				'FN_KATEGORI' => 'required|string|max:20',
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

	public function editing($id, $param1)
	{
		try {
			$this->edit = false;
			$kategori = Kategori::where('FNO_KATEGORI', '=', $id)->where('FK_GROUP', '=', $param1)->firstOrFail();
			$this->edit = $kategori;
			$this->emit('bukaModal');
			$this->FNO_KATEGORI = $kategori->FNO_KATEGORI;
			$this->FK_GROUP = $kategori->FK_GROUP;
			$this->FN_GROUP = $kategori->group->FN_GROUP;
			$this->FN_KATEGORI = $kategori->FN_KATEGORI;
		} catch (\Exception $e) {
			$this->edit = false;
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
		$this->FK_GROUP = '';
	}

	public function editFalse()
	{
		$this->clear();
	}
}
