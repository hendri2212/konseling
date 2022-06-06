<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Soal;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        // for ($i=0; $i < 1; $i++) { 
            $insert = new Soal;
            $insert->id                 = $faker->randomDigitNot(0, 1, 2);
            $insert->soal               = 'Saya merasa belum disiplin dalam beribadah pada Tuhan YME';
            $insert->rumusan_kebutuhan  = 'Kesadaran untuk beriman dan bertakwa pada Tuhan YME';
            $insert->materi             = 'Implementasi Iman dan Taqwa dalam kehidupan modern';
            $insert->tujuan_layanan     = 'admPeserta didik/konseli  mampu memahami pentingnya iman dan taqwa pada Tuhan YME serta dapat hidup rukun, damai dan saling menghormati antar umat beragamain';
            $insert->komponen_layanan   = 'Dasar';
            $insert->strategi_layanan   = 'Bimbingan klasikal';
            $insert->bidang_id          = 1;
            $insert->kompetensi_id      = 1;
            $insert->save();
        // }
    }
}
