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
    public function run(): void
    {
        Role::insert([
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'editor',
                'guard_name' => 'web',
            ],
            [
                'name' => 'viewer',
                'guard_name' => 'web',
            ]
        ]);

        Permission::insert([
            [
                'name' => 'create book',
                'guard_name' => 'web',
            ],
            [
                'name' => 'read book',
                'guard_name' => 'web',
            ],
            [
                'name' => 'update book',
                'guard_name' => 'web',
            ],
            [
                'name' => 'delete book',
                'guard_name' => 'web',
            ]
        ]);
        
        $admin = Role::findByName('admin');
        $admin->givePermissionTo('create book');
        $admin->givePermissionTo('read book');
        $admin->givePermissionTo('update book');
        $admin->givePermissionTo('delete book');

        $editor = Role::findByName('editor');
        $editor->givePermissionTo('create book');
        $editor->givePermissionTo('read book');
        $editor->givePermissionTo('update book');

        $viewer = Role::findByName('viewer');
        $viewer->givePermissionTo('read book');
    }
}
