<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
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
            'region_id' => function () {
                return Region::all()->random()->id;
            }
        ];
    }
}
