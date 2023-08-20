<?php

namespace Database\Factories;

use App\Models\MainCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->name;
        $icon = fake()->image;
        $slug = Str::of($name)->slug('_');
        $image = fake()->image;
        $detail = fake()->sentence();
        return [
            'creatable_type' => 'App\Models\User',
            'creatable_id' => 1,
            'name' => $name,
            'icon' => $icon,
            'slug' => $slug,
            'image' => $image,
            'detail' => $detail,
            'main_category_id' => function () {
                return MainCategory::all()->random()->id;
            },
            // 'parent_id' =>function(){
            //     return Parent::all()->random()->id;
            // }
        ];
    }
}
