<?php

namespace Database\Seeders;

use App\Models\ServiceComponent;
use Illuminate\Database\Seeder;

class ServiceComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceComponent::insert([
            [
                "id" => "d0df034f-3b41-4b49-8ab1-0aa5bc75e0f2",
                "name" => "Layanan Dasar",
                "created_at" => round(microtime(true) * 1000)
            ],

            [
                "id" => "ca76c3d9-8725-4600-b169-d46bae871765",
                "name" => "Layanan Peminatan dan Perencanaan Individual Peserta Didik",
                "created_at" => round(microtime(true) * 1000)
            ],

            [
                "id" => "8fea2647-8816-4a8b-b5c4-6afd93d97a6d",
                "name" => "Layanan Responsif",
                "created_at" => round(microtime(true) * 1000)
            ],

            [
                "id" => "1e38dd9b-b243-40b4-bfcc-add12f540b81",
                "name" => "Dukungan Sistem",
                "created_at" => round(microtime(true) * 1000)
            ],

        ]);
    }
}