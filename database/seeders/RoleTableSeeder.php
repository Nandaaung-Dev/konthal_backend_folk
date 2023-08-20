<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'system_super_admin',
            'system_admin',
            'system_manager',
            'system_finance',
            'system_customer_service'
        ];

        foreach ($roles as $role) {
            $role = Role::factory()->create(['name' => $role]);
        }
    }
}
