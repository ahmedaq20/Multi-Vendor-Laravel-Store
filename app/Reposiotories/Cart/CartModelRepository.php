<?php

namespace App\Reposiotories\Cart;


use App\Models\carts;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Reposiotories\Cart\CartRepository;

class CartModelRepository implements CartRepository
{
    protected $item;
    public function __construct(){
    $this->item= collect([]);
    }


    public function get() : Collection
    {
        if(!$this->item->count()){
                    //igar loade
        $this->item = carts::with('product')->get();
        }
        return $this->item;


    }

    public function add(Product $product, $quantity = 1)
    {
        $item = carts::where('product_id', $product->id)
            ->first();

        if (!$item) {
            $cart = carts::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,

            ]);
            //اضافة عنصر جديد على السلة
             $this->get()->push($cart);
        }
                     //باستخدمها عشان ازود واحد او حسب ايش  القيمة المبعوته
        return $item->increment('quantity',$quantity);
    }

    public function update($id, $quantity )
    {
        carts::where('id', $id)->update([
                'quantity' => $quantity,
            ]);
    }

    public function delete($id)
    {
        carts::where('id', '=', $id)->delete();
    }

    public function empty()
    {
        carts::query()->delete();
    }

    public function total() : float
    {
    //    return (float) carts::join('products', 'products.id', '=', 'carts.product_id')
    //         ->selectRaw('SUM(products.price * carts.quantity) as total')
    //         ->value('total');
    //items برتج ال
   return $this->get()->sum(function($item){
        return $item->quantity * $item->product->price;
    });

    }

    // public function addCookieId(){
    //     $cookie_id = Cookie::get('cart_id');
    //     if(!$cookie_id){
    //         $cookie_id = Str::uuid();
    //         Cookie::queue('cart_id', $cookie_id,60*24*30);
    //     }
    //     return $cookie_id;

    // }
}
