<?php

namespace Database\Seeders;

use App\Models\RolePermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_permission1 = new RolePermission;
        $role_permission1->id = Str::uuid();
        $role_permission1->role_id = '9c68d65f-ee23-4048-9c58-43cd8417e1d8';
        $role_permission1->permission_id = 'eca7b0c7-2dc6-4f8f-9cf5-b95e2f2a391a';
        $role_permission1->save();

        $role_permission2 = new RolePermission;
        $role_permission2->id = Str::uuid();
        $role_permission2->role_id = '9c68d65f-ee23-4048-9c58-43cd8417e1d8';
        $role_permission2->permission_id = '86bf5618-1017-4fc1-9cc3-f31ef98e8d95';
        $role_permission2->save();
    }
}
