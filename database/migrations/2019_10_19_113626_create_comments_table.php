<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('parentId')->unsigned()->nullable();
            $table->text('message');
            $table->bigInteger('authorId')->unsigned()->nullable();
            $table->foreign('authorId')->references('id')
                ->on('users')->onDelete('cascade');
            $table->bigInteger('advertId')->unsigned()->nullable();
            $table->foreign('advertId')->references('id')
                ->on('adverts')->onDelete('cascade');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
