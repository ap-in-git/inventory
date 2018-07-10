<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected  $fillable=[
        "subcategory_id","status","category_id","name","image","price","description","code"
    ];


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }
    public function stocks(){
        return $this->hasMany(Stock::class);
    }

    public function orders(){
        return $this->hasMany(ProductOrder::class);
    }
}
