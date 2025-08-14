<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@infoflix.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        User::factory(10)->create([
            'role_id' => $userRole->id,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => $userRole->id,
        ]);

        $this->call([
            CategoriesSeederFromAPI::class,
            TrendingMoviesSeederFromAPI::class,
        ]);
    }
}
