<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $cities = [
        ['name' => 'Yangon', 'name_mm' => 'ရန်ကုန်'],
        ['name' => 'Mandalay', 'name_mm' => 'မန္တလေး'],
        ['name' => 'Sagaing', 'name_mm' => 'စစ်ကိုင်း']
    ];
    public function run()
    {
        foreach ($this->cities as $city) {
            City::factory()->create($city);
        }
    }
}
