<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Reset Cached Permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Créer les Permissions (Actions possibles)
        $permissions = [
            // Gestion Restaurants
            'create restaurant',
            'edit own restaurant',
            'delete own restaurant',
            'delete any restaurant',  
            
            'manage menu',
             
            'book table',
            'manage bookings', 
           
            'write review',
            'manage reviews', 
            
            'access dashboard',
            'manage users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
 
        $clientRole = Role::create(['name' => 'client']);
        $clientRole->givePermissionTo([
            'book table',
            'write review',
        ]);
 
        $restaurateurRole = Role::create(['name' => 'restaurateur']);
        $restaurateurRole->givePermissionTo([
            'create restaurant',
            'edit own restaurant',
            'delete own restaurant',
            'manage menu',
            'manage bookings',
            'access dashboard',  
        ]);

    
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());  
 
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@bookmytable.com',
            'password' => Hash::make('password123'),
        ]);
        $admin->assignRole('admin');
         
        $restoUser = User::create([
            'name' => 'Chef Ramsay',
            'email' => 'chef@kitchen.com',
            'password' => Hash::make('password123'),
        ]);
        $restoUser->assignRole('restaurateur');
    }
}