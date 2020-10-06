<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use ShoppingCart;

class Cart extends Component
{
	public $cart = [];
	public $total = null;

	protected $listeners = [
		'refresh' => 'refreshCart',
		'addQtyE' => 'addQty',
		'minusQtyE' => 'minusQty',
		'delItem' => 'deleteItem',
	];

	public function mount()
	{		
		if (auth()->check()) {
			$cart = ShoppingCart::session(auth()->user()->id);
		} else {
			$cart = ShoppingCart::session(date('Ymd'));
		}
		$this->total = $cart->getTotal();
		$this->cart = array_replace($this->cart, $cart->getContent()->toArray());
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
}
