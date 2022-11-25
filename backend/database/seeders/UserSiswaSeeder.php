<?php

namespace Database\Seeders;

use App\Models\SiswaUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $siswa = new SiswaUser;
        $siswa->id = "9afe9167-ef26-4b9f-a67d-c6a3e67e7f35";
        $siswa->username = 'dayatsyarif';
        $siswa->nama = 'syarif';
        $siswa->password = Hash::make('12345678');
        $siswa->sekolah_id = '07087f31-ecfb-419b-aecf-c00d6f6f74cf';
        $siswa->email_verified_at = date("Y-m-d H:i:s");
        $siswa->save();
    }
}
