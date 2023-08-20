<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Township;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Owner>
 */
class OwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'creatable_type'=> 'App\Models\User',
            'creatable_id'=>1,
            'username'=>fake()->name,
            'email' =>fake()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
            'name'=>fake()->name,
            'phone_number'=>fake()->phoneNumber,
            'viber_number'=>fake()->phoneNumber,
            'city_id' => function () {
                return City::all()->random()->id;
            },
            'township_id' => function() {
                return Township::all()->random()->id;
            },
            'address'=>fake()->address,
        ];
    }
}
