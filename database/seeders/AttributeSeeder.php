<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $attributes = [
    ['name'=>'Color', 'name_mm'=>'အရောင်'],
    ['name'=>'Size','name_mm'=>'အရွယ်အစား']
    ];
    public function run()
    {
        foreach ($this->attributes as $attribute) {
            Attribute::factory()->create($attribute);
        }
    }
}
