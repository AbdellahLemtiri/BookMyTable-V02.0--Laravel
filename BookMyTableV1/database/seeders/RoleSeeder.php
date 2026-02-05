<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();


        // Communes
        Permission::firstOrCreate(['name' => 'modifier profil']);

        // Client
        Permission::firstOrCreate(['name' => 'rechercher restaurants']);
        Permission::firstOrCreate(['name' => 'consulter details restaurant']);
        Permission::firstOrCreate(['name' => 'ajouter favoris']);
        Permission::firstOrCreate(['name' => 'reserver table']);

        // Restaurateur
        Permission::firstOrCreate(['name' => 'creer restaurant']);
        Permission::firstOrCreate(['name' => 'modifier propre restaurant']);
        Permission::firstOrCreate(['name' => 'supprimer propre restaurant']);
        Permission::firstOrCreate(['name' => 'gerer menus']);
        Permission::firstOrCreate(['name' => 'gerer plats']);

        // Admin
        Permission::firstOrCreate(['name' => 'supprimer nimporte quel restaurant']);
        Permission::firstOrCreate(['name' => 'acceder dashboard admin']);
        Permission::firstOrCreate(['name' => 'gerer utilisateurs']);
        Permission::firstOrCreate(['name' => 'gerer roles']);
        Permission::firstOrCreate(['name' => 'gerer permissions']);
        // visiteur
        Permission::firstOrCreate(['name' => 'login']);




        // --- ROLES ---
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $restaurateur = Role::firstOrCreate(['name' => 'restaurateur']);
        $client = Role::firstOrCreate(['name' => 'client']);
        $visiteur = Role::firstOrCreate(['name' => 'visiteur']);

        // Admin :  
        $admin->givePermissionTo(Permission::all());

        // Restaurateur
        $restaurateur->givePermissionTo([
            'modifier profil',
            'creer restaurant',
            'modifier propre restaurant',
            'supprimer propre restaurant',
            'gerer menus'
        ]);

        // Client
        $client->givePermissionTo([
            'modifier profil',
            'rechercher restaurants',
            'consulter details restaurant',
            'ajouter favoris',
            'reserver table'
        ]);

        // Visiteur
        $visiteur->givePermissionTo([
            'login'
        ]);
        }
}
