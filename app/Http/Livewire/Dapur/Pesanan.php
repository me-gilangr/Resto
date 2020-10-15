<?php

namespace App\Http\Livewire\Dapur;

use App\Models\PemasakanDetail;
use App\Models\PemasakanHeader;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pesanan extends Component
{
	public $data_pesanan = []; 
	public $data_pemasakan = [];

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
		$pesanan = PesananDetail::whereHas('menuDetail.produk.groupBuat', function($q) {
			$q->where('FTEMPAT', '=', 'D');
		})->where('FSTATUS_PESAN', '=', '2')->get();
		$this->reset(['data_pesanan']);
		$this->fill(['data_pesanan' => $pesanan]);
	}
	
	public function ambilPesanan($kodeDetail, $kodePesanan, $kodeMenu)
	{
		try {
			$pesanan = PesananDetail::where('FNO_D_PESAN', '=', $kodeDetail)->where('FNO_H_PESAN', '=', $kodePesanan)->where('FNO_H_MENU', '=', $kodeMenu)->firstOrFail();
			DB::beginTransaction();

			$updateStatus = PesananDetail::where('FNO_H_PESAN', '=', $kodePesanan)
			->where('FNO_H_MENU', '=', $kodeMenu)
			->update([
				'FSTATUS_PESAN' => '3',
			]);

			$masak = PemasakanHeader::firstOrCreate([
				'FNO_H_PEMASAKAN' => time(),
				'FNO_D_PESAN' => $pesanan->FNO_D_PESAN,
				'USER_ID' => auth()->user()->id,
			]);

			$jml = $pesanan->FJML;

			foreach ($pesanan->menuDetail as $key => $value) {
				$detail = PemasakanDetail::firstOrCreate([
					'FNO_H_PEMASAKAN' => $masak->FNO_H_PEMASAKAN,
					'FNO_PRODUK' => $value->produk->FNO_PRODUK,
					'FJML' => $jml,
					'FSTATUS' => 0,
				]);
			}

			DB::commit();

			$this->emit('success', 'Pesanan di-Masukan Daftar Masak.');
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
		return view('livewire.dapur.pesanan');
	}
}
