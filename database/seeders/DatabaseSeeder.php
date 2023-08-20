<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProviderBranche;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RegionTableSeeder::class,
            CityTableSeeder::class,
            TownshipTableSeeder::class,
            DepartmentSeeder::class,
            PaymentMethodSeeder::class,
            PaymentTypeSeeder::class,
            ProviderSeeder::class,
            ProviderBrancheSeeder::class,
            TypeTableSeeder::class,
            OwnerTableSeeder::class,
            ShopTypeTableSeeder::class,
            ShopTableSeeder::class,
            BranchTableSeeder::class,
            ShopDepartmentSeeder::class,
            ShopStaffTableSeeder::class,
            MainCategoryTableSeeder::class,
            KonthalStaffSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class
        ]);
    }
}
