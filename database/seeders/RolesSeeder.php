<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Usuário com acesso total ao sistema',
        ]);

        Role::create([
            'name' => 'user',
            'display_name' => 'Usuário',
            'description' => 'Usuário comum com acesso limitado',
        ]);
    }
}
