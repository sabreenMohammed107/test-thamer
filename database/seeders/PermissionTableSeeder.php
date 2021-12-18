<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'roles-list',
            'roles-create',
            'roles-edit',
            'roles-delete',

            'users-list',
            'users-create',
            'users-edit',
            'users-delete',

            'cases-list',
            'cases-create',
            'cases-edit',
            'cases-delete',
        ];
   // for update data commit olde and open new and udate admin user
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
