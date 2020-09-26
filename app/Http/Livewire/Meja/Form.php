<?php

namespace App\Http\Livewire\Meja;

use Livewire\Component;

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
	
}
