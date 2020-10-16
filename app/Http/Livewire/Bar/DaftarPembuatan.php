<?php

namespace App\Http\Livewire\Bar;

use App\Models\PemasakanDetail;
use App\Models\PemasakanHeader;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DaftarPembuatan extends Component
{
	public $data_pemasakan = [];

	protected $listeners = [
		'get_pemasakan' => 'getPemasakan',
	];

	public function render()
	{
		return view('livewire.bar.daftar-pembuatan');
	}

	public function getPemasakan()
	{
		try {
			$data = PemasakanHeader::with('detail.produk.groupBuat')
			->where('USER_ID', '=', auth()->user()->id)->get();
			$this->reset(['data_pemasakan']);
			$this->fill(['data_pemasakan' => $data]);
		} catch (\Exception $e) {
			dd($e);
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function selesai($kodePemasakan, $kodeProduk)
	{
		try {
			DB::beginTransaction();

			$pemasakan = PemasakanHeader::findOrFail($kodePemasakan);
			$produk = $pemasakan->detail()->where('FNO_H_PEMASAKAN', '=', $kodePemasakan)->whereHas('produk.groupBuat', function ($q) {
				$q->where('FTEMPAT', '=', 'B');
			})->get();
			
			foreach ($produk as $key => $value) {
				$update = PemasakanDetail::where('FNO_H_PEMASAKAN', '=', $value->FNO_H_PEMASAKAN)
					->where('FNO_PRODUK', '=', $value->FNO_PRODUK)
					->update([
						'FSTATUS' => 1,
					]);
			}

			$status = 1;
			foreach ($pemasakan->detail as $key => $value) {
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
				$pesanan = PesananDetail::where('FNO_D_PESAN', '=', $pemasakan->FNO_D_PESAN)->firstOrFail();
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
