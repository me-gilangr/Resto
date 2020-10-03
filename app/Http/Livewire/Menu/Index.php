<?php

namespace App\Http\Livewire\Menu;

use App\Models\HeaderMenu;
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
		return view('livewire.menu.index');
	}
	
	public function deleting($kode)
	{
		try {
			$menu = HeaderMenu::findOrFail($kode);
			$menu->update([
				'FSTATUS' => 0
			]);
			$menu->delete();
			
			$this->emit('updatedDataTable');
			$this->emit('warning', 'Data Menu di-Hapus !');
			
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function restoring($kode)
	{
		try {
			$menu = HeaderMenu::onlyTrashed()->findOrFail($kode);
			$menu->restore();

			$this->emit('updatedDataTable');
			$this->emit('info', 'Data di-Pulihkan !');
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function activating($kode)
	{
		try {
			$activate = HeaderMenu::findOrFail($kode);
			$activate->update([
				'FSTATUS' => 1
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
			$activate = HeaderMenu::findOrFail($kode);
			$activate->update([
				'FSTATUS' => 0
			]);

			$this->emit('updatedDataTable');
			$this->emit('warning', 'Data di Non-Aktifkan');
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

}
