<?php

namespace Database\Seeders;

use App\Models\Type_blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_bloods')->delete();

        $bloodTypes = ['O-','O+','B-','B+','A-','A+','AB-','AB+'];

        foreach ($bloodTypes as $type){
            Type_blood::create(['name'=> $type]);
        }
    }
}
