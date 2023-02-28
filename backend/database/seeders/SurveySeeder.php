<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $angket = new Survey;
        $angket->id = '50224ef8-964a-4e35-cj24-be7821bcd219';
        $angket->name = 'Survey semester genap 2022';
        $angket->class_id = '50284ff8-064a-4e55-b624-bd7425acf272';
        $angket->status = 'open';
        $angket->created_at = round(microtime(true) * 1000);
        $angket->save();
    }
}
