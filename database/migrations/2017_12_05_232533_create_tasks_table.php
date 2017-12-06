<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->string('subject');
            $table->text('description');
            $table->string('status');
            $table->string('priority');
            $table->date('start_date');
            $table->date('due_date');
            $table->float('estimated_hours')->nullable();
            $table->float('actual_hours')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('registered_user_id')->unsigned();
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
        Schema::dropIfExists('tasks');
    }
}
