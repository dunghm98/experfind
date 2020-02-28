<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        factory(\App\User::class, 50)->create();
//        factory(\App\Student::class, 25)->create();
//        factory(\App\Tutor::class, 25)->create();
        factory(\App\Speciality::class, 5)->create();
        factory(\App\Subject::class, 10)->create();
        factory(\App\City::class, 64)->create();
        factory(\App\District::class, 100)->create();


    }
}
