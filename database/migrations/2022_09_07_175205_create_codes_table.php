<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes_tb', function (Blueprint $table) {
            $table->id();
            $table->integer("main_cd");
            $table->integer("sub_cd");
            $table->string("desc_ar");
            $table->string("desc_en")->nullable();
            $table->integer("controller_id")->default(0);
            $table->integer("page_id")->default(0);
            $table->integer("is_active");
            $table->integer("created_by");
            $table->integer("updated_by");
            $table->timestamps();
            $table->unique(["main_cd","sub_cd"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codes_tb');
    }
}
