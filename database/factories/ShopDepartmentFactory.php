<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\ShopDepartment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShopDepartment>
 */
class ShopDepartmentFactory extends Factory
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
            'shop_id' => function () {
                return Shop::all()->random()->id;
            }
        ];
    }
}
