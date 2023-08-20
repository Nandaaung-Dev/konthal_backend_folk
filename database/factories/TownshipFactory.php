<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Township>
 */
class TownshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'creatable_type' => 'App\Models\User',
            'creatable_id' => 1,
            'name' => fake()->name,
            'name_mm' => fake()->name,
            'city_id' => function () {
                return City::all()->random()->id;
            }
        ];
    }
}
