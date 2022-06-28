<?php

use Illuminate\Database\Seeder;

class MostProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::where('is_admin', 0)->get()->each(function ($user) {
            $mostProject = factory(App\Most_project::class, rand(1, 10))->make();
            $user->most_projects()->saveMany($mostProject);
        });
    }
}
