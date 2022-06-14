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
        $siswa->nisn = '120120';
        $siswa->nama = 'syarif';
        $siswa->email = 'siswa@gmail.com';
        $siswa->password = Hash::make('12345678');
        $siswa->tahun_masuk = date('Y');
        $siswa->sekolah_id = '07087f31-ecfb-419b-aecf-c00d6f6f74cf';
        $siswa->kelas_id = "50284ff8-064a-4e55-b624-bd7425acf272";
        $siswa->email_verified_at = date("Y-m-d H:i:s");
        $siswa->save();
    }
}
