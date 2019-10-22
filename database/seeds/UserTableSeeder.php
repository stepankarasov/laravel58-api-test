<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name'     => 'Test name',
            'email'    => 'name@test.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name'     => 'Tester',
            'email'    => 'tester@test.ru',
            'password' => Hash::make('12345678'),
        ]);
    }
}
