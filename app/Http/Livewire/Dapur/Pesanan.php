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
		$this->getPemasakan();
		$pesanan = PesananDetail::with('header.meja')->with('menu.header')->with('menu.produk.groupBuat')->whereHas('menu.produk.groupBuat', function($q) {
			$q->where('FTEMPAT', '=', 'D');
		})->orderBy('created_at', 'ASC')->get()->toArray();
		// dd($pesanan[0]);
		$this->fill(['data_pesanan' => $pesanan]);
	}

	public function getPemasakan()
	{
		$pemasakan = PemasakanHeader::with('pesananHeader')
			->with('menuHeader')
			->where('USER_ID', '=', auth()->user()->id)
			->get()->toArray();
		$this->fill(['data_pemasakan' => $pemasakan]);	
	}

	public function cekPemasakan($noPesan, $noMenu)
	{
		$found = current(array_filter($this->data_pemasakan, function($item) use($noPesan, $noMenu) {
			return isset($item['FNO_PESAN']) && $noPesan == $item['FNO_PESAN'] && isset($item['FNO_H_MENU']) && $noMenu == $item['FNO_H_MENU'];
		}));

		return $found;
	}

	public function ambilPesanan($kodePesanan, $kodeMenu)
	{
		try {
			$pesanan = PesananDetail::where('FNO_PESAN', '=', $kodePesanan)->where('FNO_H_MENU', '=', $kodeMenu)->firstOrFail();
			DB::beginTransaction();

			$updateStatus = PesananDetail::where('FNO_PESAN', '=', $kodePesanan)->where('FNO_H_MENU', '=', $kodeMenu)->update([
				'FSTATUS_PESAN' => '3',
			]);

			$masak = PemasakanHeader::firstOrCreate([
				'FNO_H_PEMASAKAN' => time(),
				'FNO_PESAN' => $pesanan->FNO_PESAN,
				'FNO_H_MENU' => $pesanan->FNO_H_MENU,
				'USER_ID' => auth()->user()->id,
			]);

			$jml = $pesanan->FJML;

			foreach ($pesanan->menu->produk as $key => $value) {
				$detail = PemasakanDetail::firstOrCreate([
					'FNO_H_PEMASAKAN' => $masak->FNO_H_PEMASAKAN,
					'FNO_PRODUK' => $value->FNO_PRODUK,
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
