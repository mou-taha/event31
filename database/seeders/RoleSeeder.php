<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Administrateur',
            'Manager',
            'Utilisateur',
        ];

        $rolesToInsert = array_map(function($role) {
            return [
                'name' => $role,
                'guard_name' => 'web',
            ];
        }, $roles);

        // Insérer les roles dans la base de données
        DB::table('roles')->insert($rolesToInsert);
    }
}
