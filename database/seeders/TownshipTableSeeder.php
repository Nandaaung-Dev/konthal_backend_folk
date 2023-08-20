<?php

namespace Database\Seeders;

use App\Models\Township;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TownshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $townships = [
        ['name' => 'Yangon', 'name_mm' => 'ရန်ကုန်'],
        ['name' => 'Mandalay', 'name_mm' => 'မန္တလေး'],
        ['name' => 'Sagaing', 'name_mm' => 'စစ်ကိုင်း']
    ];
    public function run()
    {
        foreach ($this->townships as $township) {
            Township::factory()->create($township);
        }
    }
}
