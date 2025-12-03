<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //permission for products
        Permission::create(['name' => 'product.index']);
        Permission::create(['name' => 'product.create']);
        Permission::create(['name' => 'product.edit']);
        Permission::create(['name' => 'product.delete']);

        //permission for images
        Permission::create(['name' => 'image.index']);
        Permission::create(['name' => 'image.create']);
        Permission::create(['name' => 'image.edit']);
        Permission::create(['name' => 'image.delete']);

        //permission for roles
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.delete']);

        //permission for permissions
        Permission::create(['name' => 'permissions.index']);

        //permission for users
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);
    }
}
