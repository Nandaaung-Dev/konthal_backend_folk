<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
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
            'shipping_address' => json_encode(["city" => "Yangon", "township" => "Hlaing"]),
            'billing_address' => json_encode(["city" => "Yangon", "township" => "Hlaing"]),
            'customer_id' => function () {
                return Customer::all()->random()->id;
            }
        ];
    }
}
