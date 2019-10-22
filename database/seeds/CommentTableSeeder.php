<?php

use App\Advert;
use App\Comment;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();

        $users = User::all();
        $authorId1 = $users[0]->id;
        $authorId2 = $users[1]->id;

        $adverts = Advert::all();
        $advertId1 = $adverts[0]->id;
        $advertId2 = $adverts[0]->id;

        $comment1 = Comment::create([
            'parentId' => null,
            'message'  => 'Hello! It\'s me',
            'authorId' => $authorId1,
            'advertId' => $advertId1,
            'status'   => 1
        ]);

        Comment::create([
            'parentId' => $comment1->id,
            'message'  => 'Hi!',
            'authorId' => $authorId2,
            'advertId' => $advertId2,
            'status'   => 1
        ]);
    }
}
