<?php

namespace App\Http\Livewire\Frontend;

use App\Models\DetailMenu;
use App\Models\HeaderMenu;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Cart;

class DaftarMenu extends Component
{
	public $detail = [
		'FNO_H_MENU' => null,
		'FN_MENU' => null,
		'FGAMBAR' => null,
		'FHARGAJUAL' => null,
	];

	public $jml = 1;

	public function render()
	{
		$menu = DB::select( DB::raw('
		SELECT
			d.FNO_KATEGORI,
			d.FN_KATEGORI,
			b.FN_MENU,
			b.FHARGAJUAL,
			b.FGAMBAR,
			b.FNO_H_MENU
		FROM t00_d_menu as a
		INNER JOIN t00_h_menu as b
		on a.FNO_H_MENU=b.FNO_H_MENU
		INNER JOIN t00_m_produk as c
		on c.FNO_PRODUK=a.FNO_PRODUK
		INNER JOIN t00_ref_produk as d
		on d.FNO_KATEGORI=c.FNO_KATEGORI
		WHERE b.deleted_at IS NULL
		GROUP BY d.FNO_KATEGORI, d.FN_KATEGORI,	b.FN_MENU,	b.FHARGAJUAL,	b.FGAMBAR, b.FNO_H_MENU') );

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
				$cartId = rand(100,999);
			}

			$cart = Cart::session(auth()->user()->id);
			$cart->add([
				'id' => $cartId,
				'name' => $menu->header->FN_MENU,
				'price' => $menu->header->FHARGAJUAL,
				'quantity' => $this->jml,
				'attributes' => [],
				'associatedModel' => $menu,
			]);

			dd(session()->all());
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
	}
}
