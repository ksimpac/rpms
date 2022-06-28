<?php

use Illuminate\Database\Seeder;

class ThesisConfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::where('is_admin', 0)->get()->each(function ($user) {
            $thesisConf = factory(App\Thesis_conf::class, rand(1, 10))->make();
            $user->thesis_confs()->saveMany($thesisConf);
        });
    }
}
