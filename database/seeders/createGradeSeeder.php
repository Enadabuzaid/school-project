<?php

namespace Database\Seeders;

use App\Models\Grade\Grade;
use Illuminate\Database\Seeder;

class createGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::create([
            'grade_name' => [
                'en' => 'Preschool' ,
                'ar' => 'المرحلة التمهيدية'
            ],
            'notes' =>[
                'en' => 'Age 3-5' ,
                'ar' => 'العمر 3-5'
            ]
        ]);

        Grade::create([
            'grade_name' => [
                'en' => 'Primary' ,
                'ar' => 'المرحلة الابتدائية'
            ],
            'notes' =>[
                'en' => 'Age 6-14' ,
                'ar' => 'العمر 6-14'
            ]
        ]);


        Grade::create([
            'grade_name' => [
                'en' => 'Secondary' ,
                'ar' => 'المرحلة الثانوية'
            ],
            'notes' =>[
                'en' => 'Age 14-18' ,
                'ar' => 'العمر 14-18'
            ]
        ]);


    }
}
