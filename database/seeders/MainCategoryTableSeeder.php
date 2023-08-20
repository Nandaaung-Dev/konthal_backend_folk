<?php

namespace Database\Seeders;

use App\Models\MainCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $categories = [
        ['name' => 'Fruits & Vegetables', 'name_mm' => ''],
        ['name' => 'Grocery & Dry Goods', 'name_mm' => ''],
        ['name' => 'Meat & Seafood', 'name_mm' => ''],
        ['name' => 'Baby & Mother Care', 'name_mm' => ''],
        ['name' => 'Ready To Eat', 'name_mm' => ''],
        ['name' => 'Electronics', 'name_mm' => ''],
        ['name' => 'Stationery', 'name_mm' => ''],
        ['name' => 'Monks Accessories', 'name_mm' => ''],
        ['name' => 'Food', 'name_mm' => ''],
        ['name' => 'Medicine', 'name_mm' => ''],
        ['name' => 'Clothes', 'name_mm' => ''],
        ['name' => 'Liquor', 'name_mm' => '']
    ];
    public function run()
    {
        foreach($this->categories as $category) {
            MainCategory::factory()->create($category);
        }
    }
}
