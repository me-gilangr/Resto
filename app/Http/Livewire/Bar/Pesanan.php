<?php

namespace App\Http\Livewire\Bar;

use App\Models\PemasakanDetail;
use App\Models\PemasakanHeader;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\DB;
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
		$pesanan = PemasakanDetail::where('FTEMPAT', '=', 'B')->where('FSTATUS', '=', '0')->where('USER_ID', '=', null)->get();
		$this->reset(['data_pesanan']);
		$this->fill(['data_pesanan' => $pesanan]);
	}
	
	public function ambilPesanan($kodePemasakan)
	{
		try {
			$pemasakan = PemasakanDetail::where('FNO_D_PEMASAKAN', '=', $kodePemasakan)->firstOrFail();
			DB::beginTransaction();

			$pemasakan->header->pesananDetail()->update(['FSTATUS_PESAN' => '3']);
			$pemasakan->update([
				'USER_ID' => auth()->user()->id,
			]);

			DB::commit();

			$this->emit('success', 'Pesanan di-Masukan Daftar Buat.');
			$this->getPesanan();
			$this->emit('get_pemasakan');

		} catch (\Exception $e) {
			DB::rollback();
			$this->emit('error', 'Terjadi Kesalahan !');
			dd($e);
		}
	}

	public function dumpPesanan()
	{
		dd($this->data_pesanan);
	}

	public function render()
	{
		return view('livewire.bar.pesanan');
	}
}
