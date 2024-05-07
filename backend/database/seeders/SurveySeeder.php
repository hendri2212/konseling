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
        $angket->id = '94757351-03a4-4fea-8cad-b16a60e396f2';
        $angket->name = 'Survey semester genap 2022';
        $angket->number_of_survey_items = 50;
        $angket->class_name = "RPL";
        $angket->class_id = '50284ff8-064a-4e55-b624-bd7425acf272';
        $angket->school_id = '07087f31-ecfb-419b-aecf-c00d6f6f74cf';
        $angket->status = 'open';
        $angket->created_at = round(microtime(true) * 1000);
        $angket->save();
    }
}
