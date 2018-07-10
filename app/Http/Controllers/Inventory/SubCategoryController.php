<?php

namespace App\Http\Controllers\Inventory;

use App\Model\Category;
use App\Model\Product;
use App\Model\Stock;
use App\Model\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    if($request->has("category")){
        $subcategories=SubCategory::select("id","name")->where("category_id",$request->get("category"))->get();
         return response()->json($subcategories,200);
    }
        $subcategories=SubCategory::all();
        return view("inventory.subcategory.index",compact("subcategories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::select("id","name")->get();

        return view("inventory.subcategory.create",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            "category"=>"required|exists:categories,id",
            "name"=>"required|unique:sub_categories,name"
        ]);

        SubCategory::create([
            "category_id"=>$request->get("category"),
            "name"=>$request->get("name")
        ]);

        Session::flash("success","Subcategory added successfully");

        return redirect()->route("subcategory.index");
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory=SubCategory::findorfail($id);
        $categories=Category::select("id","name")->get();

        return view("inventory.subcategory.edit",compact("categories","subcategory"));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subcategory=SubCategory::findorfail($id);
        $this->validate($request,[
            "category"=>"required|exists:categories,id",
            "name"=>"required|unique:sub_categories,name"
        ]);
        $subcategory->update([
            "category_id"=>$request->get("category"),
            "name"=>$request->get("name")
        ]);

        Session::flash("success","Subcategory Updated successfully");
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $subcategory=SubCategory::findorfail($id);
        $products=Product::select("id")->where("subcategory_id",$id)->get();
        foreach ($products as $product){
           $stocks=Stock::where("product_id",$product->id)->get();
           foreach ($stocks as $stock){
               $stock->delete();
           }
           $product->delete();
        }

        $subcategory->delete();

        Session::flash("success","Subcategory has been deleted ");

        return back();

    }
}
