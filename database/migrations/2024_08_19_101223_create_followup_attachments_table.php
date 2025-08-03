<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowupAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followup_attachments', function (Blueprint $table) {
            $table->unsignedBigInteger("id")->primary();
            $table->string("followup_id");
            $table->string("path")->nullable();
            $table->string("note")->nullable();
            $table->unsignedBigInteger("created_by");
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
        Schema::dropIfExists('followup_attachments');
    }
}
