<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $regions = [
        ['name'=>'Yangon','name_mm'=>'ရန်ကုန်'],
        ['name'=>'Mandalay','name_mm'=>'မန္တလေး'],
        ['name'=>'Sagaing','name_mm'=>'စစ်ကိုင်း']
    ];
    public function run()
    {
        foreach($this->regions as $region) {
            $user = User::find(1);
            // $user->regions()->create($region);
            $user->morphMany(Region::class,'creatable')->create($region);
        }
    }
}
