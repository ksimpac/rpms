<?php

use Illuminate\Database\Seeder;

class OtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::where('is_admin', 0)->get()->each(function ($user) {
            $other = factory(App\Other::class, rand(0, 10))->make();
            $user->others()->saveMany($other);
        });
    }
}
