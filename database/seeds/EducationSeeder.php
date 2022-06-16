<?php

use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::where('is_admin', 0)->get()->each(function () {
            $degreeElements = array('Bachelor', 'Master', 'PhD');
            foreach ($degreeElements as $element) {
                factory(App\Education::class)->create([
                    'degree' => $element
                ]);
            }
        });
    }
}
