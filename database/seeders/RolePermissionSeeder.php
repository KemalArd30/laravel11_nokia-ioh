<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Buat permissions
        $permissions = [
            'create', 
            'read', 
            'update', 
            'delete', 
            'edit'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role Admin dan berikan semua permission
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Buat role User dan berikan permission edit dan update saja
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo(['edit', 'update']);
    }
}