<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Shop;
use App\Models\ShopType;
use App\Models\Township;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->name;
        $slug = Str::of($name)->slug('_');
        return [
            'creatable_type' => 'App\Models\User',
            'creatable_id' => 1,
            'name'=>fake()->name,
            'name_mm'=>fake()->name,
            
            'phone_number'=>fake()->phoneNumber,
            'shop_id'=>function(){
                return Shop::all()->random()->id;
            },
            
            'shop_type_id'=>function(){
                return ShopType::all()->random()->id;
            },
            'city_id'=>function(){
                return City::all()->random()->id;
            },
            'township_id'=>function(){
                return Township::all()->random()->id;
            },
            'slug'=>$slug,
            'address'=>fake()->address,
            'is_main_branch'=>fake()->boolean(),
            'description'=>fake()->paragraph()
        ];
    }
}
