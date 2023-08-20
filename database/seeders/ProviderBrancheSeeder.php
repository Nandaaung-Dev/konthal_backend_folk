<?php

namespace Database\Seeders;

use App\Models\ProviderBranche;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProviderBrancheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProviderBranche::factory()->count(4)->create();
    }
}
