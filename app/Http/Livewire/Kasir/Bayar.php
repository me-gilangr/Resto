<?php

namespace App\Http\Livewire\Kasir;

use App\Models\PesananDetail;
use Livewire\Component;

class Bayar extends Component
{
  public $menu = [];
  public $total = 0;
  public $bayar = 0;
  public $kembalian = 0;

  protected $listeners = [
    'get_detail' => 'getDetail'
  ];

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
    $this->kembalian = $this->bayar - $this->total;
  }

  public function getDetail($detail)
  {
    try {
      $detail = PesananDetail::with('menuHeader')->findOrFail($detail)->toArray();
      $detail['max'] = $detail['FJML'];
      $this->menu[$detail['FNO_D_PESAN']] = $detail;
      $this->total += $detail['FHARGA'] * $detail['FJML'];
      $this->kembalian = $this->bayar - $this->total;
    } catch (\Exception $e) {
      dd($e);
    }
  }

  public function updatedMenu($value)
  {
    $total = 0;
    foreach ($this->menu as $value) {
      $total += $value['FHARGA'] * $value['FJML'];
    }

    $this->total = $total;
    $this->kembalian = $this->bayar - $this->total;
  }
  
  public function removeMenu($no)
  {
    unset($this->menu[$no]);
  }
}
