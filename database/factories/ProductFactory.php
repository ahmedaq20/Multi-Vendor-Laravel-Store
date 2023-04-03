<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Store;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name=$this->faker->words(5,true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(15),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(1,1,499),
            'compare_price'=>$this->faker->randomFloat(1,500,999),
            // هان بجيب ال اي دي بشكل عشوائي من الجدول وباخد اول واحد
            'category_id'=> Category::inRandomOrder()->first()->id,
            'featured'=>rand(0,1),
            'store_id'=> Store::inRandomOrder()->first()->id,
        ];
    }
}
