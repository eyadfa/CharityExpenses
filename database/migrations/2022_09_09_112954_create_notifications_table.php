<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_tb', function (Blueprint $table) {
            $table->unsignedBigInteger("id")->primary();
            $table->integer('user_id');
            $table->integer('status')->comment('0:new , 1:seen');
            $table->string('title');
            $table->string('body');
            $table->string('related_url');
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
        Schema::dropIfExists('notifications_tb');
    }
}
