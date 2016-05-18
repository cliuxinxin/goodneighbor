<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTable extends Migration
{
    /**
     * status:在途，需要冻结
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_id')->unsigned()->nullable();
            $table->foreign('from_id')->references('id')->on('users');

            $table->integer('to_id')->unsigned()->nullable();
            $table->foreign('to_id')->references('id')->on('users');

            $table->integer('task_id')->unsigned()->nullable();
            $table->foreign('task_id')->references('id')->on('tasks');

            $table->string('status')->nullable();
            $table->string('details')->nullable();
            $table->integer('points');
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
        Schema::drop('points');
    }
}
