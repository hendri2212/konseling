<?php

namespace Database\Seeders;

use App\Models\Ujian;
use Illuminate\Database\Seeder;

class UjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ujian = new Ujian;
        $ujian->id = '50224ef8-964a-4e35-cj24-be7821bcd219';
        $ujian->nama = 'Angket semester genap 2022';
        $ujian->tanggal = date("Y-m-d H:i:s");
        $ujian->kelas_id = '50284ff8-064a-4e55-b624-bd7425acf272';
        $ujian->status = 'open';
        $ujian->save();
    }
}
