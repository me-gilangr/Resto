<?php

namespace App\Http\Livewire\Dapur;

use App\Models\PesananDetail;
use Livewire\Component;

class Pesanan extends Component
{
	public $data_pesanan = []; 

	protected $listeners = [
		'get_pesanan' => 'getPesanan'
	];

	public function hydrate()
	{
		// $this->getPesanan();
	}

	public function mount()
	{
		// $this->getPesanan();
	}

	public function getPesanan()
	{
		// $pesanan = PesananDetail::with('menu.produk.groupBuat')->whereHas('menu.produk.groupBuat', function($q) {
		// 	$q->where('FTEMPAT', '=', 'D');
		// })->get();
		$pesanan = PesananDetail::get();
		$this->fill(['data_pesanan' => $pesanan]);
		// dd($pesanan->toArray());
	}

	public function render()
	{
		return view('livewire.dapur.pesanan');
	}
}
