<?php

namespace App\Http\Livewire\KodeGroup;

use App\Models\KodeGroup;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Form extends Component
{
	public $FK_GROUP = '';
	public $FN_GROUP = '';
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
		return view('livewire.kode-group.form');
	}

	public function updatedFKGroup($value)
	{
		$data = Validator::make(
			[
				'FK_GROUP' => $this->FK_GROUP,
			],
			[
				'FK_GROUP' => 'required|alpha_num|min:1|max:1|unique:t00_ref_kategori,FK_GROUP',
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

	public function updatedFNGroup()
	{
		$data = Validator::make(
			[
				'FN_GROUP' => $this->FN_GROUP,
			],
			[
				'FN_GROUP' => 'required|string|max:20',
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
			$simpan = KodeGroup::firstOrCreate($data);

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
				'FK_GROUP' => $this->FK_GROUP,
				'FN_GROUP' => $this->FN_GROUP,
			],
			[
				'FK_GROUP' => 'required|string|min:1|max:1|unique:t00_ref_kategori,FK_GROUP',
				'FN_GROUP' => 'required|string|max:20',
			],
			[
				'string' => 'Isi Harus Berupa Alphanumeric (A-Z, 0-9, a-z) !',
				'required' => 'Field Wajib di-Isi / Tidak Boleh Kosong !',
				'max' => 'Jumlah Huruf Tidak Boleh Lebih Dari :max Karakter',
				'min' => 'Jumlah Huruf Harus Berjumlah :min Karakter',
				'unique' => 'Data Sudah Ada !',
			]
		)->validate();

		return $data;
	}

	public function editing($id)
	{
		try {
			$this->edit = false;
			$group = KodeGroup::findOrFail($id);
			$this->edit = $group;
			$this->emit('bukaModal');
			$this->FK_GROUP = $group->FK_GROUP;
			$this->FN_GROUP = $group->FN_GROUP;
		} catch (\Exception $e) {
			dd($e);
			$edit = false;
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function updateData($kode)
	{
		try {
			$group = KodeGroup::findOrFail($kode);
			$group->update([
				'FN_GROUP' => $this->FN_GROUP,
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
		$this->FK_GROUP = '';
		$this->FN_GROUP = '';
	}

	public function editFalse()
	{
		$this->clear();
	}
}
