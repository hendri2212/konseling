<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
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
                'id' => '59bcb75b-f90c-4f0e-bc9c-4c01ae452220',
                'service' => 'service',
                'description' => 'Fitur untuk mengelola fitur-fitur'
            ],
            [
                'id' => '41b3c74a-717b-4aed-95ca-b75d242c92ac',
                'service' => 'role',
                'description' => 'Fitur untuk mengelola role'
            ]
        ];

        for ($i=0; $i<count($data); $i++) {
            $service = new Service;
            $service->id = $data[$i]['id'];
            $service->service = $data[$i]['service'];
            $service->description = $data[$i]['description'];
            $service->save();
        }
    }
}
