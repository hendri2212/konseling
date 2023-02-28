<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = new Student;
        $student->id = "9afe9167-ef26-4b9f-a67d-c6a3e67e7f35";
        $student->email = 'dayatsyarif';
        $student->name = 'syarif';
        $student->password = Hash::make('12345678');
        $student->school_id = '07087f31-ecfb-419b-aecf-c00d6f6f74cf';
        $student->created_at = round(microtime(true) * 1000);
        $student->save();
    }
}
