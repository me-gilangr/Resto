<?php

namespace App\Http\Livewire\Meja;

use App\Models\Meja;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Form extends Component
{
	public $FNO_MEJA = '';
	public $FJENIS = '';
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
		return view('livewire.meja.form');
	}

	public function tambah()
	{
		$data = $this->validating();

		try {
			$simpan = Meja::firstOrCreate($data);

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
				'FNO_MEJA' => $this->FNO_MEJA,
				'FJENIS' => $this->FJENIS,
			],
			[
				'FNO_MEJA' => 'required|string|max:3|unique:t00_m_meja,FNO_MEJA',
				'FJENIS' => 'required|string|max:20',
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
			$meja = Meja::findOrFail($id);
			$this->edit = $meja;
			$this->emit('bukaModal');
			$this->FNO_MEJA = $meja->FNO_MEJA;
			$this->FJENIS = $meja->FJENIS;
		} catch (\Exception $e) {
			$edit = false;
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function updateData($kode)
	{
		try {
			$meja = Meja::findOrFail($kode);
			$meja->update([
				'FJENIS' => $this->FJENIS,
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
		$this->FNO_MEJA = '';
		$this->FJENIS = '';
	}

	public function editFalse()
	{
		$this->clear();
	}
}
