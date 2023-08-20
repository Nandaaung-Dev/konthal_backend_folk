<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Database\Seeders\PermissionTableSeeder;
use Database\Seeders\RoleTableSeeder;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class CreateSystemSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:system_super_admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Creating System Super Admin...');
        try {
            $this->call('db:seed', [
                '--class' => PermissionTableSeeder::class,
            ]);
            $this->call('db:seed', [
                '--class' => RoleTableSeeder::class,
            ]);
            $user = ['name' => 'System Super Admin', 'email' => 'system_super_admin@gmail.com', 'password' => Hash::make('password')];
            $user = User::factory()->create($user);
            $this->info('System Super Admin was created successfully.');
            $system_super_admin_role = Role::first();
            $all_permissions = Permission::all();
            $system_super_admin_role->givePermissionTo($all_permissions);
            $user->assignRole($system_super_admin_role);
            $this->info('Email: ' . $user->email);
            $this->info('Password: password');
            $this->createTeam($user);
        } catch (Exception $e) {
            $this->error('Error while creating system_super_admin:' . $e->getMessage());
        }
    }
    protected function createTeam(User $user)
    {
        $this->info('Creating Team...');
        try {
            $user->ownedTeams()->save(Team::forceCreate([
                'user_id' => $user->id,
                'name' => explode(' ', $user->name, 2)[0] . "'s Team",
                'personal_team' => true,
            ]));
            $this->info('Team was created!');
        } catch (Exception $e) {
            $this->error('Error while Cereating Team: ' . $e->getMessage());
        }
    }
}
