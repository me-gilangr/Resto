<?php

namespace App\Http\Livewire\Meja;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Form extends Component
{
	public $FNO_MEJA = '';
	public $FJENIS = '';
	public $edit = false;

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

		$simpan = Satuan::firstOrCreate([
			'FNO_MEJA' => $this->FNO_MEJA,
			'FJENIS' => $this->FJENIS
		]);

		$this->clear();
		$this->emit('tutupModal');
		$this->emit('updatedDataTable');
		$this->emit('success', 'Berhasil Menambahkan Data !');
	}

	public function validating()
	{
		$data = Validator::make(
			[
				'FNO_MEJA' => $this->FNO_MEJA
			],
			['FNO_MEJA' => 'required|string|max:3'],
			[
				'string' => 'Isi Harus Berupa Alphanumeric !',
				'required' => 'Field Wajib di-Isi / Tidak Boleh Kosong !',
				'max' => 'Jumlah Huruf Tidak Boleh Lebih Dari 3 Karakter',
			]
		)->validate();

		return $data;
	}
}
