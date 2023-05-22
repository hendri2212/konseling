<?php

namespace Database\Seeders;

use App\Models\SurveyAttempt;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call([

            UserSeeder::class,
            TeacherSeeder::class,
            ClassSeeder::class,
            SurveySeeder::class,
            StudentSeeder::class,
            FieldComponentSeeder::class,
            SkkpdSeeder::class,
            ServiceComponentSeeder::class,
            TopicSeeder::class,
            RequirementFormulationSeeder::class,
            SurveyItemSeeder::class,
            SurveyAttemptSeeder::class,
            DefaultServiceImplementationPlanDetailSeeder::class,
        ]);
    }
}
