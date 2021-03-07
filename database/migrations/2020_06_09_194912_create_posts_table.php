<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('slug');
            $table->enum('status', ['published', 'draft']);
            $table->string('title');
            $table->text('abstractContent')->nullable();
            $table->text('fullContent')->nullable();
            $table->string('sourceURL', 500);
            $table->string('imageURL', 500);
            $table->string('platforms', 300)->nullable();
            $table->boolean('disableComment')->default(false);
            $table->smallInteger('importance')->default(0);
            $table->string('author')->nullable();
            $table->string('reviewer')->nullable();
            $table->string('type');
            $table->integer('pageviews')->default(0);
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
