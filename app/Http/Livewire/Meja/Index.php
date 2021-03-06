<?php

namespace App\Http\Livewire\Meja;

use App\Models\Meja;
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
		return view('livewire.meja.index');
	}
	
	public function deleting($kode)
	{
		try {
			$meja = Meja::findOrFail($kode);
			$meja->update([
				'STATUS' => 0
			]);
			$meja->delete();
			
			$this->emit('updatedDataTable');
			$this->emit('warning', 'Data Meja di-Hapus !');
			
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function restoring($kode)
	{
		try {
			$meja = Meja::onlyTrashed()->findOrFail($kode);
			$meja->restore();

			$this->emit('updatedDataTable');
			$this->emit('info', 'Data di-Pulihkan !');
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function activating($kode)
	{
		try {
			$activate = Meja::findOrFail($kode);
			$activate->update([
				'STATUS' => 1
			]);

			$this->emit('updatedDataTable');
			$this->emit('success', 'Data di-Aktifasi');
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function deactivating($kode)
	{
		try {
			$activate = Meja::findOrFail($kode);
			$activate->update([
				'STATUS' => 0
			]);

			$this->emit('updatedDataTable');
			$this->emit('warning', 'Data di Non-Aktifkan');
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}
}
