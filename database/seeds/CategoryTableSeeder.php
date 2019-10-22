<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        $category1 = Category::create([
            'name'        => 'Category 1',
            'description' => 'Category 1 description',
            'parentId'    => null,
            'status'      => 1
        ]);

        Category::create([
            'name'        => 'Category 2',
            'description' => 'Category 2 description',
            'parentId'    => $category1->id,
            'status'      => 1
        ]);
    }
}
