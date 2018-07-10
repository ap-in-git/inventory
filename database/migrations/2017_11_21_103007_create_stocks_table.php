<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("product_id")->unsigned();
            $table->integer("size_id")->unsigned();
            $table->integer("user_id")->unsigned();
            $table->integer("quantity")->unsigned();
            $table->string("code");
            $table->integer("price");
            $table->integer("bought_price");
            $table->timestamps();

            $table->foreign("product_id")->references("id")->on("products")->onDelete("cascade");
            $table->foreign("size_id")->references("id")->on("sizes")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
