<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'member']);
        Role::create(['name' => 'staff']);
        Role::create(['name' => 'admin']);
        Permission::create(['name' => 'edit'])->assignRole('admin', 'staff');
        Permission::create(['name' => 'add'])->assignRole('admin', 'staff', 'member');
        Permission::create(['name' => 'delete'])->assignRole('admin');

    }
}
