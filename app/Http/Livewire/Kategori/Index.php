<?php

namespace App\Http\Livewire\Kategori;

use App\Models\Kategori;
use Livewire\Component;

class Index extends Component
{
	protected $listeners = [
		'hapus' => 'deleting',
		'restore' => 'restoring',
		'activate' => 'activating',
		'deactivate' => 'deactivating',
	];

	public function render()
	{
		return view('livewire.kategori.index');
	}
	
	public function deleting($kode)
	{
		try {
			$kategori = Kategori::findOrFail($kode);
			$kategori->delete();
			
			$this->emit('updatedDataTable');
			$this->emit('warning', 'Data Kategori di-Hapus !');
			
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function restoring($kode)
	{
		try {
			$kategori = Kategori::onlyTrashed()->findOrFail($kode);
			$kategori->restore();

			$this->emit('updatedDataTable');
			$this->emit('info', 'Data di-Pulihkan !');
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}
}
