<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_leaders', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name","50");
            $table->string("position","200");
            $table->string("image");
            $table->text("saying");
            $table->integer("view_position");
            $table->string("fb_link")->nullable();
            $table->string("twitter_link")->nullable();
            $table->string("linked_in_link")->nullable();
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
        Schema::dropIfExists('company_leaders');
    }
}
