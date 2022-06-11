<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bidang::insert([
            ["id" => "3bdd628e-267c-469d-802f-14557fd0e622", "nama" => "pribadi"],
            ["id" => "a40879c0-7943-4b6e-9766-cfa0a2b64baa", "nama" => "sosial"],
            ["id" => "b374344b-9e60-45b3-89c6-fe4d57220d58", "nama" => "belajar"],
            ["id" => "eeb613e4-4b46-4681-a28a-86f1a113237e", "nama" => "karir"],
        ]);
    }
}
