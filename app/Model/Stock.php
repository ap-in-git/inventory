<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable=['product_id','size_id','user_id','code','code','price','quantity','bought_price'];

   public function product(){
       return $this->belongsTo(Product::class);
   }

   public function size(){
       return $this->belongsTo(Size::class);
   }


}
