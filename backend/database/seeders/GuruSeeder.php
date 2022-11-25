<?php

namespace Database\Seeders;

use App\Models\GuruUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GuruUser::create([
            "id" => "b810b389-387c-438f-94f0-2fcd1326592c",
            "username" => "120",
            "password" => Hash::make("12345678"),
            "nama" => "guru dummy",
            "status" => NULL,
            "sekolah_id" => "07087f31-ecfb-419b-aecf-c00d6f6f74cf",
        ]);
    }
}
