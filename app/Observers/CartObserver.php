<?php

namespace App\Observers;

use App\Models\carts;
use Illuminate\Support\Str;

class CartObserver
{
    /**
     * Handle the carts "creating" event.
     *
     * @param  \App\Models\carts  $carts
     * @return void
     */
    public function creating(carts $cart)
    {
        $cart->id = Str::uuid();
       $cart->cookie_id= carts::addCookieId();

    }

    /**
     * Handle the carts "updated" event.
     *
     * @param  \App\Models\carts  $carts
     * @return void
     */
    public function updated(carts $carts)
    {
        //
    }

    /**
     * Handle the carts "deleted" event.
     *
     * @param  \App\Models\carts  $carts
     * @return void
     */
    public function deleted(carts $carts)
    {
        //
    }

    /**
     * Handle the carts "restored" event.
     *
     * @param  \App\Models\carts  $carts
     * @return void
     */
    public function restored(carts $carts)
    {
        //
    }

    /**
     * Handle the carts "force deleted" event.
     *
     * @param  \App\Models\carts  $carts
     * @return void
     */
    public function forceDeleted(carts $carts)
    {
        //
    }
}
