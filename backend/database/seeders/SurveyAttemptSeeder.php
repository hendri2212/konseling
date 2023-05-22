<?php

namespace Database\Seeders;

use App\Models\SurveyAttempt;
use Illuminate\Database\Seeder;

class SurveyAttemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $survey_attempt = new SurveyAttempt;
        $survey_attempt->id = '29993999-ae65-4767-841d-53a5b226f074';
        $survey_attempt->survey_id = '50224ef8-964a-4e35-cj24-be7821bcd219';
        $survey_attempt->student_id = '9afe9167-ef26-4b9f-a67d-c6a3e67e7f35';
        $survey_attempt->school_id = '07087f31-ecfb-419b-aecf-c00d6f6f74cf';
        $survey_attempt->state = 'finished';
        $survey_attempt->sumgrades = 33;
        $survey_attempt->timestart = 167815984889;
        $survey_attempt->timefinish = 1678159670092;
        $survey_attempt->created_at = 1678159160689;
        $survey_attempt->updated_at = 1678159670092;
        $survey_attempt->save();
    }
}
