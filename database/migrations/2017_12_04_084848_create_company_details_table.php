<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string("company_name",50);
            $table->string("logo_url");
            $table->string("city",50);
            $table->string("district",20);
            $table->string("phone_no");
            $table->string("short_detail");
            $table->string("email",40);
            $table->string("cell_no");
            $table->integer("latitude");
            $table->integer("longitude");
            $table->string("fb_link")->nullable();
            $table->string("twitter_link")->nullable();
            $table->string("linked_in_link")->nullable();
            $table->string("insta_link")->nullable();
            $table->text("company_overview")->nullable();

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
        Schema::dropIfExists('company_details');
    }
}
