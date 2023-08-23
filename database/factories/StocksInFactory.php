<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StocksIn>
 */
class StocksInFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' =>fake()->name(),
            'int_no' =>random_int(0,100000),
            'category_id' => random_int(0,20),
            'image_id' => '1',
            'date' => fake()->date(),
            'quantity' => random_int(0,100),
            'price' => random_int(0,1000),
        ];
    }
}