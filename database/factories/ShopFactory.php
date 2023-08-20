<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Owner;
use App\Models\ShopType;
use App\Models\Township;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   $name=fake()->name;
        $name_mm=fake()->name;
        $slug=Str::of($name)->slug('-');
        return [
            'creatable_type' => 'App\Models\User',
            'creatable_id' => 1,
            'name'=>$name,
            'name_mm'=>$name_mm,
            'slug'=>$slug,
            'phone_number'=>fake()->phoneNumber,
            'shop_type_id'=>function() {
                return ShopType::all()->random()->id;
            },
            
            'owner_id'=>function() {
                return Owner::all()->random()->id;
            },
            'city_id' => function () {
                return City::all()->random()->id;
            },
            'township_id'=>function() {
                return Township::all()->random()->id;
            },
            'address'=>fake()->address,
            'description'=>fake()->paragraph()

        ];
    }
}
