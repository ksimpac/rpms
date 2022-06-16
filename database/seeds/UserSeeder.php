<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'nutc6200',
            'password' => '$2y$10$wnaC35vsdk4hgHRduCBZeuHZG9py1n2nDWSr2k.tC8BQpFNv0wWaS',
            'chineseName' => '系辦',
            'email' => '',
            'National_ID_No' => '',
            'email_verified_at' => null,
            'is_admin' => 1,
            'isSignup' => 0,
        ]);

        factory(User::class, 50)->create();
    }
}
