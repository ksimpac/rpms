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
        App\User::where('is_admin', 0)->get()->each(function ($user) {
            $degreeElements = array('Bachelor', 'Master', 'PhD');
            foreach ($degreeElements as $element) {
                $education = factory(App\Education::class)->make(['degree' => $element]);
                $user->educations()->save($education);
            }
        });
    }
}
