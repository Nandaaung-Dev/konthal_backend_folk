<?php

namespace Database\Seeders;

use App\Models\KonthalStaff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KonthalStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KonthalStaff::factory()->count(10)->create();
    }
}
