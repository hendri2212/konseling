<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new AdminUser();
        $admin->id = '89be28f0-78dc-4fa2-8aee-279fd85fc1b9';
        $admin->nama = 'admin';
        $admin->email = 'syarifmuhammad369@gmail.com';
        $admin->password = Hash::make('superuser*');
        $admin->email_verified_at = date("Y-m-d H:i:s");
        $admin->role_id = '9c68d65f-ee23-4048-9c58-43cd8417e1d8';
        $admin->save();
    }
}
