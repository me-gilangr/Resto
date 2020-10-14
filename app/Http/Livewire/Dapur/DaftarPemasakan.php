<?php

namespace App\Http\Livewire\Dapur;

use App\Models\PemasakanHeader;
use Livewire\Component;

class DaftarPemasakan extends Component
{
	public $data_pemasakan = [];

	protected $listeners = [
		'get_pemasakan' => 'getPemasakan',
	];

	public function render()
	{
		return view('livewire.dapur.daftar-pemasakan');
	}

	public function getPemasakan()
	{
		try {
			$data = PemasakanHeader::where('USER_ID', '=', auth()->user()->id)->get();
			$this->reset(['data_pemasakan']);
			$this->fill(['data_pemasakan' => $data]);
			// dd($data);
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}
}
