<?php

namespace App\View\Components;

use App\Facade\Cart;
use App\Reposiotories\Cart\CartRepository;
use Illuminate\View\Component;

class CartMenu extends Component
{

    public $items;

    public $total;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    // public function __construct()
    // {        //cart Facade inecte to CartModelRepository-> use get method in this repository
    //    $this->items= Cart::get();
    //    $this->total=  Cart::total();
    // }


    public function __construct(CartRepository $cart)
    {
       $this->items= $cart->get();
       $this->total=  $cart->total();
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-menu');
    }
}
