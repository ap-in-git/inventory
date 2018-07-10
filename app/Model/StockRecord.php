<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StockRecord extends Model
{
    protected $fillable=['product_id','product_name','size_id','size_name','user_id','user_name','code','bought_price','quantity',"notes","type"];
}
