<?php

namespace App\Http\Livewire\Kasir;

use App\Models\PesananDetail;
use App\Models\PesananHeader;
use Livewire\Component;

class DataMenu extends Component
{
    public $FNO_H_PESAN = null;
    public $pesanan = [];

    public function mount($pesanan)
    {
      $this->FNO_H_PESAN = $pesanan->FNO_H_PESAN;
      $this->pesanan = $pesanan;
    }

    public function render()
    {
      return view('livewire.kasir.data-menu');
    }

    public function getPesanan()
    {
      try {
        $pesanan = PesananHeader::findOrFail($this->FNO_H_PESAN);
        $this->pesanan = $pesanan;
      } catch (\Exception $e) {
        dd($e);
      }
    }

    public function payMenu($no)
    {
      try {
        $this->emit('get_detail', $no);
      } catch (\Exception $e) {
        dd($e);
      }
    }

}
