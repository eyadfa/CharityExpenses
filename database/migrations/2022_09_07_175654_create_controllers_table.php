<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controllers_tb', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("caption")->nullable();
            $table->string("folder_name")->nullable();
            $table->integer("menu_show")->default(1);
            $table->integer("is_active")->default(1);
            $table->integer("sequence")->nullable();
            $table->string('gate')->nullable();
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
        Schema::dropIfExists('controllers_tb');
    }
}
