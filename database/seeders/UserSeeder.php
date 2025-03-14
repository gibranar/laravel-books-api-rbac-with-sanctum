<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $editor = User::create([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $viewer = User::create([
            'name' => 'Viewer',
            'email' => 'viewer@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('admin');
        $editor->assignRole('editor');
        $viewer->assignRole('viewer');
    }
}
