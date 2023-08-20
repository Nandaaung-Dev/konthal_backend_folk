<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $departments = [
        ['name'=>'HR'],
        ['name'=>'IT'],
        ['name'=>'CS'],
    ];
    public function run()
    {
        foreach($this->departments as $department) {
            Department::factory()->create($department);
        }
    }
}
