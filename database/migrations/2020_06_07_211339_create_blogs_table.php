<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_tag_id')->index('blog_tag_id');
            $table->unsignedBigInteger('author_id')->index('author_id');
            $table->string('title', 255)->comment('Post title');
            $table->text('description')->comment('Post description');
            $table->longText('body')->comment('The post body');
            $table->string('image', 255)->comment('Post header image');
            $table->boolean('is_published')->comment('Either the post is published or not. 0 indicates saved draft while 1 indicates published');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('blog_tag_id')->references('id')->on('blog_tags');
            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
