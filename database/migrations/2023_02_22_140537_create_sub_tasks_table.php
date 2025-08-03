<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_subs', function (Blueprint $table) {
            $table->unsignedBigInteger("id")->primary();
            $table->unsignedBigInteger("task_id");
            $table->string("title");
            $table->dateTime("start_date");
            $table->dateTime("due_date");
            $table->integer("is_finished")->default(0);
            $table->text("finish_note")->nullable();
            $table->dateTime("finished_at")->nullable();
            $table->text("details")->nullable();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("assigned_to");
            $table->unsignedBigInteger("finished_by")->nullable();
            $table->SoftDeletes();
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
        Schema::dropIfExists('tasks_subs');
    }
}
