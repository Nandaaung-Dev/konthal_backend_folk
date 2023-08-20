<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Type>
 */
class TypeFactory extends Factory
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
        $name_mm=fake()->name;
        $slug = Str::of($name)->slug('_');
        $image = fake()->image;
        return [
            'creatable_type' => 'App\Models\User',
            'creatable_id' => 1,
            'name' => $name,
            'name_mm'=>$name_mm,
            'icon' => $icon,
            'slug' => $slug,
            'image' => $image

        ];
    }
}
