<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo('users_manage', 'projects_manage', 'clients_manage', 'tasks_manage');

        $role2 = Role::create(['name' => 'project manager']);
        $role2->givePermissionTo('projects_manage', 'tasks_manage');

        $role3 = Role::create(['name' => 'member']);
        $role3->givePermissionTo('projects_manage', 'tasks_manage');
    }
}
