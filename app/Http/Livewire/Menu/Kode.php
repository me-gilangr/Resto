<?php

namespace App\Http\Livewire\Menu;

use App\Models\KodeGroup;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Kode extends Component
{
	public $FK_GROUP = '';
	public $FNO_KATEGORI = '';
	public $FNO_H_MENU = '';

	public function hydrate()
	{
		$this->resetErrorBag();
		$this->resetValidation();
	}

	public function render()
	{
		$kodeGroup = KodeGroup::get();
		return view('livewire.menu.kode', compact('kodeGroup'));
	}

	public function updatedFNOGroup($value)
	{
		$this->FNO_H_MENU = '';
	}

	public function updatedFNOKategori($value)
	{
		$this->FNO_H_MENU = '';
	}

	public function updatedFNOHMenu($value)
	{
		$data = Validator::make(
			[
				'FNO_H_MENU' => $this->FNO_KATEGORI . $this->FNO_H_MENU,
			],
			[
				'FNO_H_MENU' => 'required|alpha_num|min:5|max:5|unique:t00_h_menu,FNO_H_MENU',
			],
			[
				'alpha_num' => 'Isi Harus Berupa Alphanumeric (A-Z, 0-9, a-z) !',
				'required' => 'Field Wajib di-Isi / Tidak Boleh Kosong !',
				'max' => 'Jumlah Huruf Tidak Boleh Lebih Dari :max Karakter',
				'min' => 'Jumlah Huruf Harus Berjumlah :min Karakter (Kode Kategori + Kode Produk)',
				'unique' => 'Kode Menu Sudah Ada !',
			]
		)->validate();

		return $data;
	}
}
