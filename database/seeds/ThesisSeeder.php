<?php

use Illuminate\Database\Seeder;

class ThesisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::where('is_admin', 0)->get()->each(function ($user) {
            $thesis = factory(App\Thesis::class, rand(1, 10))->make();
            $user->thesis()->saveMany($thesis);
        });
    }
}
