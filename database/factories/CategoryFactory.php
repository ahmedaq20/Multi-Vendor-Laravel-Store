<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user=$this->faker->words(2,true);
        return [
            'name' => $user,
            'slug'=> Str::slug($user),
            'description' =>$this->faker->sentence(15),
            'image' =>$this->faker->imageUrl(),
        ];
    }
}
