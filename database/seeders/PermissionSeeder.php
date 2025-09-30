<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Lire Permission',
            'Créer Permission',
            'Modifier Permission',
            'Supprimer Permission',
            'Lire Role',
            'Créer Role',
            'Modifier Role',
            'Supprimer Role',
            'Lire Utilisateur',
            'Créer Utilisateur',
            'Modifier Utilisateur',
            'Supprimer Utilisateur',
            'Lire Categorie',
            'Créer Categorie',
            'Modifier Categorie',
            'Supprimer Categorie',
            'Lire Tag',
            'Créer Tag',
            'Modifier Tag',
            'Supprimer Tag',
            'Lire Menu',
            'Créer Menu',
            'Modifier Menu',
            'Supprimer Menu',
            'Lire Type',
            'Créer Type',
            'Modifier Type',
            'Supprimer Type',
            'Lire Soustype',
            'Créer Soustype',
            'Modifier Soustype',
            'Supprimer Soustype',
            'Lire Ville',
            'Créer Ville',
            'Modifier Ville',
            'Supprimer Ville',
            'Lire Organisme',
            'Créer Organisme',
            'Modifier Organisme',
            'Supprimer Organisme',
            'Lire Access',
            'Créer Access',
            'Modifier Access',
            'Supprimer Access',
            'Lire Blog',
            'Créer Blog',
            'Modifier Blog',
            'Supprimer Blog',
            'Lire Publication',
            'Créer Publication',
            'Modifier Publication',
            'Supprimer Publication',
        ];

        $permissionsToInsert = array_map(function($permission) {
            return [
                'name' => $permission,
                'guard_name' => 'web',
            ];
        }, $permissions);

        // Insérer les permissions dans la base de données
        DB::table('permissions')->insert($permissionsToInsert);
    }
}
