<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\MainCategory;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'name' => fake()->name,
            'name_mm' => fake()->name,
            'price' => fake()->randomFloat(2, 1, 100),
            'slug' => $slug,
            'main_category_id' => function () {
                return MainCategory::all()->random()->id;
            },
            'shop_id' => function () {
                return Shop::all()->random()->id;
            },
            'branch_id' => function () {
                return Branch::all()->random()->id;
            },
            'brand_id' => function () {
                return Brand::all()->random()->id;
            },

        ];
    }
}
