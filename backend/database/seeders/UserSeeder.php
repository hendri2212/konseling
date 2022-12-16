<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use App\Models\SekolahUser;
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
        $admin->username = 'admin';
        $admin->password = Hash::make('superuser*');
        $admin->save();

        $sekolah = new SekolahUser();
        $sekolah->id = '07087f31-ecfb-419b-aecf-c00d6f6f74cf';
        $sekolah->nama = 'SMK';
        $sekolah->email = 'sekolah@gmail.com';
        $sekolah->password = Hash::make('12345678');
        $sekolah->email_verified_at = date("Y-m-d H:i:s");
        $sekolah->save();
    }
}
