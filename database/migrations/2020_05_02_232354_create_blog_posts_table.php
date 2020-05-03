<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('url_slug')->nullable();
            $table->text('summary')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->default('/images/blog-placeholder.jpg')->nullable();
            $table->string('local_author')->nullable();
            $table->datetime('published_date')->nullable();
            $table->boolean('published')->default(0);

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        Schema::create('blog_categories', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('blog_post_categories', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();

            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('post_id')->references('id')->on('blog_posts')->onDelete('cascade')->onUpdate('cascade');

            $table->unique([ 'post_id', 'category_id' ]);
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
        # Drop foreign keys
        Schema::table('blog_posts', function(Blueprint $table) {
            $table->dropForeign('blog_posts_user_id_foreign');
        });

        Schema::table('blog_post_categories', function(Blueprint $table) {
            $table->dropForeign('blog_post_categories_category_id_foreign');
            $table->dropForeign('blog_post_categories_post_id_foreign');
        });

        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('blog_categories');
        Schema::dropIfExists('blog_post_categories');
    }
}
