<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClassModel::create([
            "id" => "50284ff8-064a-4e55-b624-bd7425acf272",
            "name" => "RPL",
            "school_id" => "07087f31-ecfb-419b-aecf-c00d6f6f74cf",
            "teacher_id" => "b810b389-387c-438f-94f0-2fcd1326592c",
            "created_at" => round(microtime(true) * 1000),
        ]);
    }
}
