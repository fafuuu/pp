<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('page_number');
            $table->unsignedInteger('visibility');
            $table->text('description')->nullable();
            $table->integer('votes')->default(0);
            $table->integer('creative')->default(0);
            $table->integer('costly')->default(0);
            $table->integer('confusing')->default(0);
            $table->timestamps();

            $table->foreign('visibility')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refs');
    }
}
