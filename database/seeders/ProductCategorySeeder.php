<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $product_categories = [
        ['name'=>'Potato,Toamto,Onion','name_mm'=>'အာလူး၊ခရမ်းချဉ်၊ကြက်သွန်','main_category_id'=>1],
        ['name'=>'Chilli,Lemon,Ginger','name_mm'=>'ငရုပ်၊သံပုရာ၊ဂျင်း','main_category_id'=>1],
    ];
    public function run()
    {
        foreach($this->product_categories as $product_category) {
            ProductCategory::factory()->create($product_category);
        }
    }
}
