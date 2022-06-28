<?php

use Illuminate\Database\Seeder;

class GeneralInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::where('is_admin', 0)->get()->each(function ($user) {
            $generalInfo = factory(App\General_info::class)->make();
            $user->general_info()->save($generalInfo);
        });
    }
}
