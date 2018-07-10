<?php

namespace App\Http\Controllers\Inventory;

use App\Model\Category;
use App\Model\Product;
use App\Model\ProductOrder;
use App\Model\Quality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       if($request->has("subcategory")){
           $category_id=$request->get("subcategory");
           $products=Product::select("id","name","image","price","code")->where("subcategory_id",$category_id)->orderBy("name","asc")->get();
           return response()->json($products,200);
       }
       if($request->has("category")){
           $category_id=$request->get("category");
           $products=Product::select("id","name","image","price","code")->where("category_id",$category_id)->orderBy("name","asc")->get();
           return response()->json($products,200);
       }


        $products=Product::select("id","name","category_id","image","price")->with("category")->orderBy("name","asc")->get();
        return view("inventory.product.index",compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qualities=Quality::select("id","name")->get();
        $categories=Category::select("id","name")->orderBy("name","asc")->get();
        return view("inventory.product.create",compact("categories","qualities"));
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
            "subcategory"=>"required|exists:sub_categories,id",
            "quality"=>"required|exists:qualities,id",
            "name"=>"required|max:255",
            "price"=>"required|numeric",
            "image"=>"required|mimes:jpg,jpeg,png",
            "description"=>"required|max:1000",
            "code"=>"required|unique:products,code"
        ]);

        $file=$request->file("image");
        $filename=uniqid(true).'.png';
        $db_location='images/products/'.$filename;

        $location=public_path('images/products/'.$filename);

        Image::make($file)->encode("png")->resize(640, 360, function ($constraint) {
            $constraint->aspectRatio();
        })->save($location);


        Product::create([
            "name"=>$request->get("name"),
            "category_id"=>$request->get("category"),
            "subcategory_id"=>$request->get("subcategory"),
            "image"=>$db_location,
            "price"=>$request->get("price"),
            "description"=>$request->get("description"),
            "code"=>$request->get("code"),
            "status"=>$request->get("quality")
        ]);
        Session::flash("success","Product added successfully");

        return redirect()->route("product.index");

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
        $product=Product::findorfail($id);
        $categories=Category::select("id","name")->orderBy("name","asc")->get();
        $qualities=Quality::select("id","name")->get();

        return  view("inventory.product.edit",compact("product","categories","qualities"));
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



        $product=Product::findorfail($id);
        $this->validate($request,[

            "category"=>"required|exists:categories,id",
            "subcategory"=>"required|exists:sub_categories,id",
            "quality"=>"required|exists:qualities,id",
            "name"=>"required|max:255",
            "price"=>"required|numeric",
            "image"=>"nullable|mimes:jpg,jpeg,png",
            "description"=>"required|max:1000",
            "code"=>"required|unique:products,code,".$product->id
        ]);

        if($request->hasFile("image")){
            $old_file=public_path($product->image);

            if(file_exists($old_file))
                unlink($old_file);


            $file=$request->file("image");
            $filename=uniqid(true).'.png';
            $db_location='images/products/'.$filename;

            $location=public_path('images/products/'.$filename);

            Image::make($file)->encode("png")->resize(640, 360, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);
         $product->update([
             "name"=>$request->get("name"),
             "category_id"=>$request->get("category"),
             "image"=>$db_location,
             "price"=>$request->get("price"),
             "description"=>$request->get("description"),
             "subcategory_id"=>$request->get("subcategory"),
             "status"=>$request->get("quality"),
             "code"=>$request->get("code")
         ]);

        }else{
            $product->update([
                "name"=>$request->get("name"),
                "category_id"=>$request->get("category"),
                "price"=>$request->get("price"),
                "description"=>$request->get("description"),
                 "subcategory_id"=>$request->get("subcategory"),
                "status"=>$request->get("quality"),
              "code"=>$request->get("code")
            ]);

        }


        Session::flash("success","Product updated successfully");

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
        $product=Product::findorfail($id);

        $location=public_path($product->image);

        if(file_exists($location))
            unlink($location);
        $product_orders=ProductOrder::where("product_id",$product->id);
        foreach ($product_orders as $product_order) {
            $product_order->delete();
        }

        $product->delete();

        Session::flash("success","Product deleted successfully");

        return redirect()->route("product.index");
    }
}
