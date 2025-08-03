<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followups', function (Blueprint $table) {
            $table->unsignedBigInteger("id")->primary();
            $table->string("title");
            $table->unsignedBigInteger("follower_id");
            $table->unsignedBigInteger("item_id")->nullable();
            $table->integer("related_to");
            $table->integer("commissioning_source_cd");
            $table->string("commissioner");
            $table->date("due_date");
            $table->text("details");
            $table->text("notes")->nullable();
            $table->unsignedBigInteger("deleted_by")->nullable();
            $table->integer("is_finished")->default(0);
            $table->dateTime("finished_at")->nullable();
            $table->text("finish_note")->nullable();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by");
            $table->softDeletes();
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
        Schema::dropIfExists('followups');
    }
}
