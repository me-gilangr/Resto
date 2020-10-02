<?php

namespace App\Http\Livewire\Produk;

use App\Models\Produk;
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
		return view('livewire.produk.index');
	}
	
	public function deleting($kode)
	{
		try {
			$produk = Produk::findOrFail($kode);
			$produk->delete();
			
			$this->emit('updatedDataTable');
			$this->emit('warning', 'Data Produk di-Hapus !');
			
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function restoring($kode)
	{
		try {
			$produk = Produk::onlyTrashed()->findOrFail($kode);
			$produk->restore();

			$this->emit('updatedDataTable');
			$this->emit('info', 'Data di-Pulihkan !');
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}
}
