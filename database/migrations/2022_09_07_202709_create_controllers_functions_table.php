<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControllersFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controllers_functions_tb', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("controller_id");
            $table->string("caption")->nullable();
            $table->string("url")->nullable();
            $table->integer("is_active")->default(1);
            $table->integer("menu_show")->nullable();
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
        Schema::dropIfExists('controllers_functions_tb');
    }
}
