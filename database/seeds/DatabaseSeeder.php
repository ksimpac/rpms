<?php

use Illuminate\Database\Seeder;
use App\User;
use App\General_info;
use App\Education;
use App\Industry_experience;
use App\Most_project;
use App\Other;
use App\Tcase;
use App\Thesis;
use App\Thesis_conf;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            GeneralInfoSeeder::class,
            EducationSeeder::class,
            IndustryExperienceSeeder::class,
            MostProjectSeeder::class,
            OtherSeeder::class,
            TcaseSeeder::class,
            ThesisSeeder::class,
            ThesisConfSeeder::class,
        ]);
    }
}
