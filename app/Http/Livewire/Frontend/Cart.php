<?php

namespace App\Http\Livewire\Frontend;

use App\Models\HeaderMenu;
use App\Models\Meja;
use App\Models\PesananDetail;
use App\Models\PesananHeader;
use App\Models\PesananMeja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use ShoppingCart;

class Cart extends Component
{
	public $cart = [];
	public $total = null;
	public $meja = [];
	public $data_meja = [];
	public $atasNama = '';
	public $err_message = '';

	protected $listeners = [
		'refresh' => 'refreshCart',
		'addQtyE' => 'addQty',
		'minusQtyE' => 'minusQty',
		'delItem' => 'deleteItem',
		'upMeja' => 'upMeja',
	];

	public function hydrate()
	{
		$this->err_message = '';
	}

	public function mount()
	{		
		if (auth()->check()) {
			$cart = ShoppingCart::session(auth()->user()->id);
		} else {
			$cart = ShoppingCart::session(date('Ymd'));
		}
		$this->total = $cart->getTotal();
		$this->cart = array_replace($this->cart, $cart->getContent()->toArray());

		$data_meja = Meja::where('STATUS', '=', 1)->get()->toArray();
		$this->data_meja = $data_meja;
	}

	public function render()
	{
		return view('livewire.frontend.cart');
	}

	public function refreshCart()
	{
		if (auth()->check()) {
			$cart = ShoppingCart::session(auth()->user()->id);
		} else {
			$cart = ShoppingCart::session(date('Ymd'));
		}
		$this->cart = [];
		$this->total = $cart->getTotal();
		$this->cart = array_replace($this->cart, $cart->getContent()->toArray());
	}

	public function addQty($id)
	{
		if (auth()->check()) {
			$cart = ShoppingCart::session(auth()->user()->id);
		} else {
			$cart = ShoppingCart::session(date('Ymd'));
		}

		$cart->update($id, [
			'quantity' => +1
		]);
		
		$this->refreshCart();
		$this->emit('reDraw');
	}
	
	public function minusQty($id)
	{
		if (auth()->check()) {
			$cart = ShoppingCart::session(auth()->user()->id);
		} else {
			$cart = ShoppingCart::session(date('Ymd'));
		}

		$cart->update($id, [
			'quantity' => -1
		]);

		$this->refreshCart();
		$this->emit('reDraw');
	}

	public function deleteItem($id)
	{
		if (auth()->check()) {
			$cart = ShoppingCart::session(auth()->user()->id);
		} else {
			$cart = ShoppingCart::session(date('Ymd'));
		}

		$cart->remove($id);
		$this->refreshCart();
		$this->emit('reDraw');
	}

	public function upMeja($data)
	{
		$this->meja = array_replace($this->meja, $data);
	}

	public function pesan()
	{
		$act = $this->validating();
		if ($act == false) {
			$this->emit('error', 'Tidak Dapat Memproses Permintaan !');
		} else {
			try {
				DB::beginTransaction();

				$date = date('Y');
				$tahun = substr($date, 2, 2);
				$date = date('md');
				$kode = PesananHeader::withTrashed()->where('FNO_PESAN', 'like', $tahun.$date.'%')->get();
				if (count($kode) > 0) {
					$array = count($kode) - 1;
					$data = $kode[$array]->FNO_PESAN;
					$hapus = (int) substr($data,6,3);
					$hapus++;
					$kodePesanan = $tahun . $date . sprintf("%03s", $hapus);
				}else{
					$kodePesanan = $tahun . $date . '001';
				}

				$header = PesananHeader::firstOrCreate([
					'FNO_PESAN' => $kodePesanan,
					'TGL_PESAN' => date('Ymd'),
					'FSTATUS_TRANSAKSI' => false,
				]);

				foreach ($this->cart as $key => $value) {
					$menu = HeaderMenu::where('FNO_H_MENU', '=', $value['id'])->firstOrFail();
					$detail = PesananDetail::create([
						'FNO_PESAN' => $kodePesanan,
						'FNO_H_MENU' => $menu->FNO_H_MENU,
						'FJML' => $value['quantity'],
						'FHARGA' => $menu->FHARGAPOKOK,
						'FKET' => $value['attributes']['keterangan'],
						'FSTATUS_PESAN' => '2',
					]);
				}

				foreach ($this->meja as $key => $value) {
					$meja = Meja::where('FNO_MEJA', '=', $value)->firstOrFail();
					$mejaPesanan = PesananMeja::create([
						'FNO_PESAN' => $kodePesanan,
						'FNO_MEJA' => $meja->FNO_MEJA,
					]);

					$meja = Meja::where('FNO_MEJA', '=', $value)->update([
						'STATUS' => false,
					]);
				}

				DB::commit();

				$this->meja = array_replace($this->meja, []);
				$this->cart = array_replace($this->cart, []);
				$this->data_meja = array_replace($this->data_meja, []);
				$this->atasNama = '';
				$this->total = null;

				if (auth()->check()) {
					ShoppingCart::session(auth()->user()->id)->clear();
				} else{
					ShoppingCart::session(date('Ymd'))->clear();
				}
				$this->refreshCart();
				$this->emit('reDraw');
				$this->emit('clearSelect2');
				$this->emit('success', 'Pesanan di-Kirimkan !');
			} catch (\Exception $e) {
				DB::rollback();
				$this->emit('error', 'Terjadi Kesalahan ! Hubungi Admin !');
				dd($e);
			}
		}
	}

	public function validating()
	{
		$act = false;
		if (count($this->cart) < 1) {
			$this->err_message = 'Data Pesanan Tidak Boleh Kosong !';
		} else {
			if (count($this->meja) < 1) {
				$this->err_message = 'Silahkan Pilih Meja !';
			} else {
				if (trim($this->atasNama) == '') {
					$this->err_message = 'Masukan Atas Nama Pesanan !';
				} else {
					$this->err_message = '';
					$act = true;
				}
			}
		}

		return $act;
	}
}
