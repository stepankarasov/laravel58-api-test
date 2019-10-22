<?php

use App\Advert;
use App\Category;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('adverts')->delete();

        $users = User::all();
        $authorId1 = $users[0]->id;
        $authorId2 = $users[1]->id;

        $categories = Category::with('childrenRecursive')->whereNull('parentId')->get();
        $categoryId1 = $categories[0]->id;
        $categoryId2 = $categories[0]->id;

        Advert::create([
            'name'        => 'Sell my laptop',
            'description' => 'Lenovo IdeaPad',
            'authorId'    => $authorId1,
            'categoryId'  => $categoryId1,
            'status'      => 1
        ]);

        Advert::create([
            'name'        => 'Sell my garage',
            'description' => '3x6',
            'authorId'    => $authorId2,
            'categoryId'  => $categoryId2,
            'status'      => 1
        ]);
    }
}
