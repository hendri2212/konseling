<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 'eca7b0c7-2dc6-4f8f-9cf5-b95e2f2a391a',
                'permission' => '*',
                'service_id' => '59bcb75b-f90c-4f0e-bc9c-4c01ae452220'
            ],
            [
                'id' => '86bf5618-1017-4fc1-9cc3-f31ef98e8d95',
                'permission' => '*',
                'service_id' => '41b3c74a-717b-4aed-95ca-b75d242c92ac'
            ]
        ];

        for ($i=0; $i<count($data); $i++) {
            $permission = new Permission();
            $permission->id = $data[$i]['id'];
            $permission->permission = $data[$i]['permission'];
            $permission->service_id = $data[$i]['service_id'];
            $permission->save();
        }
    }
}
