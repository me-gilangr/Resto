<?php

namespace App\Http\Livewire\Frontend;

use App\Models\DetailMenu;
use App\Models\HeaderMenu;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use ShoppingCart;

class DaftarMenu extends Component
{
	public $detail = [
		'FNO_H_MENU' => null,
		'FN_MENU' => null,
		'FGAMBAR' => null,
		'FHARGAJUAL' => null,
	];

	public $jml = 1;
	public $ket = '';

	public function render()
	{
		$menu = HeaderMenu::where('FSTATUS', '=', 1)->get();
		return view('livewire.frontend.daftar-menu', compact('menu'));
	}

	public function test($id)
	{
		try {
			$this->clear();
			$menu = HeaderMenu::findOrFail($id);

			$this->detail = [
				'FNO_H_MENU' => $menu->FNO_H_MENU,
				'FN_MENU' => $menu->FN_MENU,
				'FGAMBAR' => $menu->FGAMBAR,
				'FHARGAJUAL' => $menu->FHARGAJUAL,
			];
			// dd($this->detail);

			$this->emit('bukaModal');
		} catch (\Exception $e) {
			$this->clear();
			$this->emit('tutupModal');
			$this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function addCart($id)
	{
		try {
			$menu = DetailMenu::where('FNO_H_MENU', '=', $id)->firstOrFail();
			if (auth()->check()) {
				$cartId = auth()->user()->id;
			} else {
				$cartId = date('Ymd');
			}

			$cart = ShoppingCart::session($cartId);
			$cart->add([
				'id' => $menu->FNO_H_MENU,
				'name' => $menu->header->FN_MENU,
				'price' => $menu->header->FHARGAJUAL,
				'quantity' => $this->jml,
				'attributes' => [
					'keterangan' => $this->ket,
				],
				'associatedModel' => $menu,
			]);

			$this->emit('success', 'Pesanan di-Masukan Keranjang !');
			$this->emit('refresh');
			$this->emit('tutupModal');
		} catch (\Exception $e) {
			dd($e);
			$this->clear();
			$this->emit('tutupModal');
			return $this->emit('error', 'Terjadi Kesalahan !');
		}
	}

	public function minus()
	{
		if ($this->jml != 0) {
			$this->jml -= 1;
		} else {
			$this->jml = 0;
		}
	}

	public function plus()
	{
		$this->jml += 1;
	}

	public function clear()
	{
		$this->detail['FNO_H_MENU'] = null;
		$this->detail['FN_MENU'] = null;
		$this->detail['FGAMBAR'] = null;
		$this->detail['FHARGAJUAL'] = null;
		$this->jml = 1;
		$this->ket = '';
	}

	public function destroySession()
	{
		session()->flush();
		$this->emit('error', 'OK DESTROYED !!');
		return redirect(route('index'));
	}
}
