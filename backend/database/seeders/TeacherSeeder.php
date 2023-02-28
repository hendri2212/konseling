<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create([
            "id" => "b810b389-387c-438f-94f0-2fcd1326592c",
            "email" => "120",
            "password" => Hash::make("12345678"),
            "name" => "teachers dummy",
            "status" => NULL,
            "school_id" => "07087f31-ecfb-419b-aecf-c00d6f6f74cf",
            "created_at" => round(microtime(true) * 1000),
        ]);
    }
}
