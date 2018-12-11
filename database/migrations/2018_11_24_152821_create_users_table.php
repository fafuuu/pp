<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role');
            $table->unsignedInteger('group_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('group_id')->references('id')->on('groups');
        });

        DB::table('users')->insert(
            array(
                'name' => 'Jon',
                'email' => 'jon@doe.com',
                'role' => 'Student',
                'group_id' => 2,
                'password' => '$2y$10$i82Qf6jR9yxLnOR3T5VRAu2gfrQhyK1xZ6wxhnNXxxXozkd45TzXm'
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'Max',
                'email' => 'max@mustermann.de',
                'role' => 'Student',
                'group_id' => 3,
                'password' => '$2y$10$i82Qf6jR9yxLnOR3T5VRAu2gfrQhyK1xZ6wxhnNXxxXozkd45TzXm'
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'testuser',
                'email' => 'testuser@mail.com',
                'role' => 'Student',
                'group_id' => 2,
                'password' => '$2y$10$F78uld/BsnkGvufiRndJPOqIoXm/9Rm8Ne/grcgrYKD9Kos9vRI2S'
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
        Schema::dropIfExists('users');
    }
}
