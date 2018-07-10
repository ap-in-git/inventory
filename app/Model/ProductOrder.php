<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
protected $fillable=["product_id","name","email","phone","quantity","note","seen"];

public function product(){
    return $this->belongsTo(Product::class,"product_id");
}
}
