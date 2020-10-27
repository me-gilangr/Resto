<?php

namespace App\Http\Livewire\Pesanan;

use App\Models\PesananDetail;
use App\Models\PesananHeader;
use Livewire\Component;

class DetailPesanan extends Component
{
	public $data_detail = [];

	protected $listeners = [
		'get_detail' => 'getDetail',
		'do_antar' => 'doAntar',
		'do_selesai' => 'doSelesai',
	];

	public function render()
	{
		return view('livewire.pesanan.detail-pesanan');
	}

	public function getDetail($id)
	{
		try {
			$pesanan = PesananHeader::findOrFail($id);
			$this->data_detail = $pesanan;
			// dd($this->data_detail->meja);
			$this->emit('bukaModal');
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function doAntar($id)
	{
		try {
			$pesanan = PesananDetail::findOrFail($id);
			$pesanan->update([
				'FSTATUS_PESAN' => '5',
			]);

			$this->emit('info', 'Status Pesanan di-Antar');
			$this->emit('get_detail', $pesanan->FNO_H_PESAN);
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function doSelesai($id)
	{
		try {
			$pesanan = PesananDetail::findOrFail($id);
			$pesanan->update([
				'FSTATUS_PESAN' => '6',
			]);

			$this->emit('success', 'Status Pesanan Selesai');
			$this->emit('get_detail', $pesanan->FNO_H_PESAN);
		} catch (\Exception $e) {
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}
}
