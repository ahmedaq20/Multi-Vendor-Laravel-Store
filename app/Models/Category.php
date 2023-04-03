<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'parent_id', 'description', 'slug', 'image', 'status'];

    public function products()
    {
        return $this->hasMany(Product::class,'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')
            ->withDefault([
                    'name' => 'Main Category'
                         ] );
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }





    //create local scope
    // public function scopeActive(Builder $builder){
    //     $builder->where('status','=' ,'active');
    // }


    //create local scope with parametar
    public function scopeStatus(Builder $builder, $status)
    {
        $builder->where('status', '=', $status);
    }
    //1
    // public function scopeFilter(Builder $builder , $filter){

    // if ($filter['name'] ?? false) {
    //     $builder->where('name', 'LIKE', "%{$filter['name']}%");
    // }
    // if ($filter['status'] ?? false) {
    //     $builder->where('status', $filter['status']);
    // }

    // }

    //2
    public function scopeFilter(Builder $builder, $filters)
    {
        //$value=$filter['name'] => value=name
        $builder->when($filters['name'] ?? false, function ($builder, $value) {
            $builder->where('categories.name', 'LIKE', "%{$value}%");
        });

        $builder->when($filters['status'] ?? false, function ($builder, $value) {

            $builder->where('categories.status', '=', $value);
        });
    }



    public static function rules($id = 0)
    {

        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                //   'unique:categories,name,$id',
                Rule::unique('categories', 'name')->ignore($id),
                /* function ($attribute,$value,$fails){
             if(strtolower($value)=='laravel'){
                 $fails('This name is forbidden');
             }
         }*/
                //an object
                // new Filter('laravel'),
                //an object (more vlaues(arry))
                new Filter(['php', 'laravel', 'html']),

            ],
            'parent_id' => [
                'nullable', 'int', 'exists:categories,id',
            ],
            'image' =>
            'image|max:1048576|dimensions:min_width:100,min_heigh:100',

            // Rule::dimensions()->maxWidth(1000)->maxHeight(500)->ratio(3 / 2),

            'status' => Rule::in(['active', 'archived']),

            // 'status'=>[
            //     'in:active,archived',
            //     Rule::in(['active', 'archived']),

            // ],




        ];
    }
}
