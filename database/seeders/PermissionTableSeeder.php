<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $web_permissions = [
            'permissions-list',
            'permissions-create',
            'permissions-edit',
            'permissions-delete',

            'roles-list',
            'roles-create',
            'roles-edit',
            'roles-delete',

            'users-list',
            'users-create',
            'users-edit',
            'users-delete',

            'regions-list',
            'regions-create',
            'regions-edit',
            'regions-delete',

            'cities-list',
            'cities-create',
            'cities-edit',
            'cities-delete',

            'townships-list',
            'townships-create',
            'townships-edit',
            'townships-delete',

            'types-list',
            'types-create',
            'types-edit',
            'types-delete',

            'categories-list',
            'categories-create',
            'categories-edit',
            'categories-delete',

            'departments-list',
            'departments-create',
            'departments-edit',
            'departments-delete',

            'payment_types-list',
            'payment_types-create',
            'payment_types-edit',
            'payment_types-delete',

            'payment_methods-list',
            'payment_methods-create',
            'payment_methods-edit',
            'payment_methods-delete',

            'providers-list',
            'providers-create',
            'providers-edit',
            'providers-delete',

            'provider_branches-list',
            'provider_branches-create',
            'provider_branches-edit',
            'provider_branches-delete',

            'shop_types-list',
            'shop_types-create',
            'shop_types-edit',
            'shop_types-delete',

            'owners-list',
            'owners-create',
            'owners-edit',
            'owners-delete',

            'shops-list',
            'shops-create',
            'shops-edit',
            'shops-delete',

            'branchs-list',
            'branchs-create',
            'branchs-edit',
            'branchs-delete',
        ];
        foreach ($web_permissions as $permission) {
            // Permission::factory()->create();
            Permission::factory()->create(['name' => $permission]);
        }
    }
}
