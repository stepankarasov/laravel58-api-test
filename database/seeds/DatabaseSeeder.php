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
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(AdvertTableSeeder::class);
        $this->call(CommentTableSeeder::class);

        $this->command->info('Tables filled with data!');
    }
}
