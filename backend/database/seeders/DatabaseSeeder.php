<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call([
            BidangSeeder::class,
            KompetensiSeeder::class,
            SoalSeeder::class,
            // ServiceSeeder::class,
            // PermissionSeeder::class,
            // RoleSeeder::class,
            // RolePermissionSeeder::class,
            // UserSeeder::class

        ]);
    }
}
