<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->count(10000)->create();

        $userAdmin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
        ]);
        $userAdmin->syncRoles('admin');

        $userUtama = User::create([
            'name' => 'Yanuarso',
            'email' => 'yan@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $userUtama->syncRoles('superadmin');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $user->syncRoles('user');
    }
}
