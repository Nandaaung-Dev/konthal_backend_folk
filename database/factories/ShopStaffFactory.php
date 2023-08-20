<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\City;
use App\Models\ShopDepartment;
use App\Models\Shop;
use App\Models\Township;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShopStaff>
 */
class ShopStaffFactory extends Factory
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
            'username'=>fake()->name,
            'name'=>fake()->name,
            'email' =>fake()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
            'phone_number'=>fake()->phoneNumber,
            'address'=>fake()->address,
            'shop_id' => function () {
                return Shop::all()->random()->id;
            },
            'branch_id' => function() {
                return Branch::all()->random()->id;
            },
            'shop_department_id' => function() {
                return ShopDepartment::all()->random()->id;
            },
            'city_id' => function() {
                return City::all()->random()->id;
            },
            'township_id' => function() {
                return Township::all()->random()->id;
            },
        ];
    }
}
