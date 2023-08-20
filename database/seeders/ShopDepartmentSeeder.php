<?php

namespace Database\Seeders;

use App\Models\ShopDepartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $shop_departments = [
        ['name' => 'HR'],
        ['name' => 'Sale'],
        ['name' => 'Finance'],
    ];
    public function run()
    {
        //
        foreach($this->shop_departments as $shop_department) {
            ShopDepartment::factory()->count(20)->create($shop_department);
        }
    }
}
