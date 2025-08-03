<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedBigInteger("id")->primary();
            $table->string("title");
            $table->integer("commissioning_source_cd");
            $table->string("commissioner");
            $table->integer("priority_cd");
            $table->dateTime("start_date");
            $table->dateTime("due_date");
            $table->integer("is_finished")->default(0);
            $table->text("finish_note")->nullable();
            $table->unsignedBigInteger("finished_by")->nullable();
            $table->dateTime("finished_at")->nullable();
            $table->text("details")->nullable();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");
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
        Schema::dropIfExists('tasks');
    }
}
