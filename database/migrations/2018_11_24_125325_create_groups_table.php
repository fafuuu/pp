<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group_name');
            $table->timestamps();
        });

        DB::table('groups')->insert(
            array(
                'group_name' => 'Alle'
            )
        );

        DB::table('groups')->insert(
            array(
                'group_name' => 'TH-Koeln'
            )
        );

        DB::table('groups')->insert(
            array(
                'group_name' => 'RWTH-Aachen'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
