<?php

namespace App\Http\Livewire\KodeGroup;

use App\Models\KodeGroup;
use Livewire\Component;

class Index extends Component
{
	protected $listeners = [
		'hapus' => 'deleting',
		'restore' => 'restoring',
	];

	public function render()
	{
		return view('livewire.kode-group.index');
	}
	
	public function deleting($kode)
	{
		try {
			$kodeGroup = KodeGroup::findOrFail($kode);
			$kodeGroup->delete();
			
			$this->emit('updatedDataTable');
			$this->emit('warning', 'Data Kode Group di-Hapus !');
			
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function restoring($kode)
	{
		try {
			$kodeGroup = KodeGroup::onlyTrashed()->findOrFail($kode);
			$kodeGroup->restore();

			$this->emit('updatedDataTable');
			$this->emit('info', 'Data di-Pulihkan !');
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}
}
