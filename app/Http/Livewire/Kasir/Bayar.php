<?php

namespace App\Http\Livewire\Kasir;

use App\Models\PembayaranDetail;
use App\Models\PembayaranHeader;
use App\Models\PesananDetail;
use App\Models\PesananHeader;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Bayar extends Component
{
	public $FNO_H_PESAN = null;
  public $menu = [];
  public $total = 0;
  public $bayar = 0;
	public $kembalian = 0;
	public $end = 0;

  protected $listeners = [
		'get_detail' => 'getDetail',
    'set_end' => 'setEnd',
    'get_all' => 'getAll',
	];
	
	public function mount($kode)
	{
		$this->FNO_H_PESAN = $kode;
		$this->setEnd();
	}

	public function setEnd()
	{
		try {
			$pesanan = PesananHeader::findOrFail($this->FNO_H_PESAN);
			$data = $pesanan->detail->pluck('FSTATUS_PESAN')->toArray();
			$end = 0;
			if (count(array_unique($data))  === 1 && end($data) === "7") {
				$end = 1;
			}

			$this->end = $end;
		} catch (\Exception $e) {
			dd($e);
		}

		$this->end = $end;
	}
	
  public function render()
  {
    return view('livewire.kasir.bayar');
  }

  public function showMenu()
  {
    dd($this->menu);
  }

  public function updatedBayar($value)
  {
    // dd($value);
    $this->kembalian = (int) $this->bayar - (int) $this->total;
  }

  public function getDetail($detail)
  {
    try {
			$detail = PesananDetail::with('menuHeader')->findOrFail($detail);
			$terbayar = 0;
			foreach ($detail->bayar as $key => $value) {
				$terbayar += $value->FJML;
			}
			$data = $detail->toArray();
			$data['max'] = $data['FJML'];
			$data['terbayar'] = $terbayar;
      $data['FJML'] -= $terbayar;
      $this->menu[$data['FNO_D_PESAN']] = $data;
      // dd($this->menu);
			$this->updatedMenu(null, null);
    } catch (\Exception $e) {
      dd($e);
    }
  }
  
  public function getAll($no)
  {
    try {
      $header = PesananHeader::findOrFail($no);
      foreach ($header->detail as $key => $value) {
        if ($value->FSTATUS_PESAN != '7') {
          $terbayar = 0;
          foreach ($value->bayar as $key => $value2) {
            $terbayar += $value2->FJML;
          }

          $data = $value->toArray();
          $data['max'] = $data['FJML'];
          $data['terbayar'] = $terbayar;
          $data['FJML'] -= $terbayar;
          $data['menu_header'] = $value->menuHeader->toArray();
          $this->menu[$data['FNO_D_PESAN']] = $data;
        }
      }

      // dd($this->menu);

      $this->updatedMenu(null, null);
    } catch (\Exception $e) {
      dd($e);
    }
  }

  public function updatedMenu($value, $key)
  {
		if ($key != null) {
			$key = explode('.', $key);
			$max = (int) $this->menu[$key[0]]['max']; 
			$val = (int) $this->menu[$key[0]]['FJML'];
	
			if ($val > $max) {
				$this->menu[$key[0]]['FJML'] = $max;
			}
		}

		$total = 0;
    foreach ($this->menu as $value) {
      $total += $value['FHARGA'] * $value['FJML'];
    }

		$this->total = $total;
		$this->kembalian = (int) $this->bayar - (int) $this->total;
	}
	
  
  public function removeMenu($no)
  {
    unset($this->menu[$no]);
	}
	
	public function payBill()
	{
		// dd($this->menu);
		try {
			DB::beginTransaction();

			$y = date('Y');
			$y = substr($y, 2, 2);
			$md = date('md');
			$kode = '';

			$headerKode = PembayaranHeader::where('FNO_H_BAYAR', 'LIKE', $y.$md.'%')->max('FNO_H_BAYAR');
			$urut = (int) substr($headerKode, 6, 3);
			$urut++;
			$kode = $y . $md . sprintf('%03s', $urut);

			$header = PembayaranHeader::create([
				'FNO_H_BAYAR' => $kode,
				'FTGL_BAYAR' => now(),
				'USER_ID' => auth()->user()->id,
				'FTOTAL' => $this->total
			]);

			foreach ($this->menu as $key => $value) {
				$detailKode = PembayaranDetail::where('FNO_D_BAYAR', 'LIKE', $kode.'%')->max('FNO_D_BAYAR');
				$urut1 = (int) substr($detailKode, 9, 2);
				$urut1++;
				$dkode = $kode . sprintf('%02s', $urut1);	

				$detail = PembayaranDetail::create([
					'FNO_D_BAYAR' => $dkode, 
					'FNO_H_BAYAR' => $kode,
					'FNO_D_PESAN' => $key,
					'FJML' => $value['FJML'],
					'FHARGA' => $value['FHARGA'],
				]);

				$jml = $detail->pesanan->FJML;
				$jml2 = $value['FJML'] + $value['terbayar'];
				if ((int) $jml == (int) $jml2) {
					$detail->pesanan()->update([
						'FSTATUS_PESAN' => 7
					]);
				}
			}

			DB::commit();

			$this->emit('success', 'Transaksi Bayar Selesai !');
			$this->emit('get_pesanan');
			$this->reset(['menu', 'total', 'bayar', 'kembalian']);
		} catch (\Exception $e) {
			DB::rollback();
			dd($e);
		}
  }
  
  public function endTransaction()
  {
    if ($this->end == 1) {
      try {
        $header = PesananHeader::findOrFail($this->FNO_H_PESAN);
        DB::beginTransaction();

        $header->update([
          'FSTATUS_TRANSAKSI' => 1,
        ]);

        foreach ($header->meja as $key => $value) {
          $value->meja->update([
            'STATUS' => true,
          ]);
        }

        DB::commit();

        $this->emit('info', 'Transaksi Selesai !');
        $this->emit('end');
      } catch (\Exception $e) {
        dd($e);
      }
    } else {
      $this->emit('warning', 'Silahkan Selesaikan Pembayaran !');
    }
  }
}
