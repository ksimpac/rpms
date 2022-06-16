<?php

use Illuminate\Database\Seeder;

class TcaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::where('is_admin', 0)->get()->each(function () {
            factory(App\Tcase::class, rand(0, 10))->create();
        });
    }
}
