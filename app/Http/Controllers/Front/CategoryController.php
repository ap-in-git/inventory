<?php

namespace App\Http\Controllers\Front;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;

class CategoryController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $products=Product::where("category_id", $id)->orderBy("created_at", "desc")->paginate(12);
        return view("public.index", compact("products"));
    }

    public function index()
    {
        $categories=  Category::select("id", "name")->with("subcategories:id,name,category_id")->get();
        
        return response()->json($categories);
    }
}
