<?php

namespace Database\Seeders;

use App\Models\Angket;
use Illuminate\Database\Seeder;

class AngketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $angket = new Angket;
        $angket->id = '50224ef8-964a-4e35-cj24-be7821bcd219';
        $angket->nama = 'Angket semester genap 2022';
        $angket->tanggal = date("Y-m-d H:i:s");
        $angket->kelas_id = '50284ff8-064a-4e55-b624-bd7425acf272';
        $angket->status = 'open';
        $angket->save();
    }
}
