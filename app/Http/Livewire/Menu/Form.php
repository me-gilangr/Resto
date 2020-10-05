<?php

namespace App\Http\Livewire\Menu;

use App\Models\Kategori;
use App\Models\KodeGroup;
use Livewire\Component;

class Form extends Component
{
	public $FK_GROUP = '';
	public $FNO_KATEGORI = '';
	public $kategori = null;

	public function render()
	{
		$kodeGroup = KodeGroup::get();
		return view('livewire.menu.form', compact('kodeGroup'));
	}

	public function updatedFKGroup($value)
	{
		$kategori = Kategori::where('FK_GROUP', '=', $value)->get();
		$this->kategori = $kategori;
	}
}
