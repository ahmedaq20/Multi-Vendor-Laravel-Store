<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;

class carts extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable= [
        'cookie_id','user_id','product_id','quantity','options'
    ];



    public static function addCookieId(){
        $cookie_id = Cookie::get('cart_id');
        if(!$cookie_id){
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id,60*24*30);
        }
        return $cookie_id;

    }



    //Events (observer)
    //creating events ,created events,updateing events ,updated events  ,deleting events ,deleted events ,
    //retrieved events, restored events ,restoring events
    public static function booted(){
        Static::observe(CartObserver::class);

        static::addGlobalScope('cookie_id',function(Builder $builder){
            $builder->where('cookie_id', carts::addCookieId());
        });
        // Static::creating(function(Carts $carts){
        //     $carts->id =Str::uuid();
        // });
    }

    public function user(){
        return $this->belongsTo(User::class)->default([
            'name' => 'Anonymous',
        ]);
    }
    public function product(){
        return $this->belongsTo(product::class);
    }


}
