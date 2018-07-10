<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**category_id
 * @property String name
 */
class Category extends Model
{
    protected $fillable=["name","category_id","image"];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
