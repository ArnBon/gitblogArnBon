<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('title');
            $table->string('url')->unique()->nullable();
            $table->text('excerpt')->nullable();
            $table->mediumText('body')->nullable();
            $table->mediumText('iframe')->nullable();
            $table->timestamp('published_at')->nullable();            
            $table->unsignedInteger('category_id')->nullable(); // agregado en el video 5 para casar la categoria con el post
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
        Schema::dropIfExists('posts');
    }
}
