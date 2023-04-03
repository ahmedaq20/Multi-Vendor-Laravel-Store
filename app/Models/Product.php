<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Tags;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
        'slug',
        'image',
        'category_id',
        'store_id',
        'description',
        'price',
        'compare_price',
        'option',
        'rating',
        'featured',
        'status',
    ];



    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    public function store()
    {
        return $this->belongsTo(Store::class,'store_id', 'id');
    }


    public static function booted()
    {
            static::addGlobalScope('store', function (Builder $builder) {
                $user = Auth::user();
                if ($user && $user->store_id) {
                $builder->where('store_id', '=', $user->store_id);
            }
        });
    }

    public function tag()
    {
        return $this->belongsToMany(
            Tags::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id',
        );
    }

    //local scope
    public function scopeActive(Builder $builder){
        return $builder->where('status','=', 'active');
    }

    //Accessors

    public function getImageUrlAttribute(){

    if(!$this->image){
        return 'https://app.advaiet.com/item_dfile/default_product.png';
    }
    if(Str::startsWith($this->image,['http://','https://'])){
        return $this->image;
    }
    return asset('storage/ '. $this->image);
    }



}
