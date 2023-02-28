<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\School;
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
        $admin = new Admin();
        $admin->id = '89be28f0-78dc-4fa2-8aee-279fd85fc1b9';
        $admin->name = 'admin';
        $admin->email = 'admin';
        $admin->password = Hash::make('superuser*');
        $admin->created_at = round(microtime(true) * 1000);
        $admin->save();

        $school = new School();
        $school->id = '07087f31-ecfb-419b-aecf-c00d6f6f74cf';
        $school->name = 'SMK';
        $school->email = 'schools@gmail.com';
        $school->password = Hash::make('12345678');
        $school->created_at = round(microtime(true) * 1000);
        $school->save();
    }
}
