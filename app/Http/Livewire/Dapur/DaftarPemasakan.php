<?php

namespace App\Http\Livewire\Dapur;

use App\Models\PemasakanDetail;
use App\Models\PemasakanHeader;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DaftarPemasakan extends Component
{
	public $data_pemasakan = [];

	protected $listeners = [
		'get_pemasakan' => 'getPemasakan',
	];

	public function render()
	{
		return view('livewire.dapur.daftar-pemasakan');
	}

	public function getPemasakan()
	{
		try {
			$pesanan = PemasakanDetail::where('FTEMPAT', '=', 'D')->where('FSTATUS', '=', '0')->where('USER_ID', '=', auth()->user()->id)->get();

			$this->reset(['data_pemasakan']);
			$this->fill(['data_pemasakan' => $pesanan]);
		} catch (\Exception $e) {
			dd($e);
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function selesai($kodePemasakan, $kodePesanan)
	{
		try {
			DB::beginTransaction();

			$pemasakan = PemasakanDetail::findOrFail($kodePemasakan);
			$pemasakan->update([
				'FSTATUS' => 1,
			]);

			$header = PemasakanHeader::where('FNO_H_PEMASAKAN', '=', $pemasakan->FNO_H_PEMASAKAN)->where('FNO_D_PESAN', '=', $kodePesanan)->firstOrFail();
			
			$status = 1;
			foreach ($header->detail as $key => $value) {
				if ($status == 1) {
					if ($value->FSTATUS == 1) {
						$status = 1;
					} else {
						$status = 0;
					}
				} else {
					break;
				}
			}

			if ($status == 1) {
				$pesanan = PesananDetail::where('FNO_D_PESAN', '=', $kodePesanan)->firstOrFail();
				$pesanan->update([
					'FSTATUS_PESAN' => '4',
				]);
			}

			DB::commit();
			$this->emit('success', 'Status Makanan Sudah di-Buat.');
			$this->emit('get_pemasakan');
		} catch (\Exception $e) {
			DB::rollback();
			$this->emit('error', 'Terjadi Kesalahan !');
			dd($e);
		}
	}
}
