<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable=["category_id","name"];

    protected $table="sub_categories";


    public function category()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
