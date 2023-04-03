<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Tags extends Model
{
    use HasFactory;

    public $timestamps= false;

    protected $fillable =[
        'name',
        'slug',
    ];

    public function products(){
        return $this->belongsToMany(
            Product::class,
            'product_tag',
            'tag_id',
            'product_id',
            'id',
            'id'

        );

    }
    // public function products(){
    //     return $this->hasMany(Product::class);

    // }

}
