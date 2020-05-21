<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('description', 255);
            $table->string('image', 255);
            $table->string('category', 100);
            $table->smallInteger('display_order')->unsigned()->unique()->comment("The order in which the projects are displayed");
            $table->string('github', 255)->nullable()->comment('Link to the github repository');
            $table->string('live', 255)->nullable()->comment('Link to the live website');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
