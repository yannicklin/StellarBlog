<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table -> integer('author_id') -> unsigned() ->default(0);
            $table->foreign('author_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->boolean('active');
            $table->string('title');
            $table->text('body');
            $table->text('excerpt');
            $table->timestamp('published_at');
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
        Schema::drop('posts');
    }
}
