<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected  $fillable=['name'];


    public function stocks(){
        return $this->hasMany(Stock::class);
    }
}
