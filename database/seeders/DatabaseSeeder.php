<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $user1 = User::factory()->create([
             'name' => 'User with both roles',
             'email' => 'test1@example.com',
         ]);

        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
        ]);

        User::factory()->times(20)->create();

        Role::create([
            'name' => 'Role 1'
        ]);

        Role::create([
            'name' => 'Role 2'
        ]);

        $user1->roles()->sync(Role::pluck('id'));
    }
}
