<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("product_id")->unsigned();
            $table->string("product_name");
            $table->integer("size_id")->unsigned();
            $table->string("size_name");
            $table->integer("user_id")->unsigned();
            $table->string("user_name");
            $table->integer("quantity")->unsigned();
            $table->string("code");
            $table->integer("bought_price");
            $table->boolean("type")->default(1);
            $table->string("notes")->nullable();
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
        Schema::dropIfExists('stock_records');
    }
}
