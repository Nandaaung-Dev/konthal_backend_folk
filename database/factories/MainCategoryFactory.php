<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class MainCategoryFactory extends Factory
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
            // 'type_id' => function () {
            //     return Type::all()->random()->id;
            // },
            // 'parent_id' =>function(){
            //     return Parent::all()->random()->id;
            // }
        ];
    }
}
