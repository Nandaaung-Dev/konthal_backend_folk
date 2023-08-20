<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Provider;
use App\Models\Township;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProviderBranche>
 */
class ProviderBrancheFactory extends Factory
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
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->numerify('###-###-####'),
            'address' => fake()->address(),
            'city_id' => function () {
                return City::all()->random()->id;
            },
            'provider_id' => function () {
                return Provider::all()->random()->id;
            },
            'township_id' => function () {
                return Township::all()->random()->id;
            },
        ];
    }
}
