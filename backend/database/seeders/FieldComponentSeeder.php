<?php

namespace Database\Seeders;

use App\Models\FieldComponent;
use Illuminate\Database\Seeder;

class FieldComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FieldComponent::insert([
            ["id" => "3bdd628e-267c-469d-802f-14557fd0e622", "name" => "pribadi", "created_at" => round(microtime(true) * 1000)],
            ["id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa", "name" => "sosial", "created_at" => round(microtime(true) * 1000)],
            ["id" => "b374344b-9e60-45b3-89c6-fe4d57220d58", "name" => "belajar", "created_at" => round(microtime(true) * 1000)],
            ["id" => "eeb613e4-4b46-4681-a28a-86f1a113237e", "name" => "karir", "created_at" => round(microtime(true) * 1000)],
        ]);
    }
}
