<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string("product_name");
            $table->string("code");
            $table->string("size");
            $table->integer("quantity");
            $table->integer("sold_price");
            $table->integer("bought_price");
            $table->integer("discount");
            $table->string("bill_no");
            $table->string("user_name");
            $table->integer("user_id");
            $table->boolean("void")->default(0);

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
        Schema::dropIfExists('transactions');
    }
}
