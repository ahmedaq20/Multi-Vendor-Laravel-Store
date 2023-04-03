<?php
namespace App\Facade;

use App\Reposiotories\Cart\CartRepository;
use Illuminate\Support\Facades\Facade;

class Cart extends Facade{

    protected static function getFacadeAccessor()
    {
        return CartRepository::class;
    }



}
