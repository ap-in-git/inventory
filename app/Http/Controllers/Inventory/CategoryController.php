<?php

namespace App\Http\Controllers\Inventory;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $categories=Category::select("id","name","image")->get();
        return view("inventory.category.index",compact("categories"));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view("inventory.category.create");
    }


    public function edit($id){
        $category=Category::findorfail($id);
        return view("inventory.category.edit",compact("category"));
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
            "name"=>"required|max:255|unique:categories,name",

        ]);

//        $file=$request->file("image");
//        $filename=uniqid(true).'.png';
//        $db_location='images/categories/'.$filename;
//
//        $location=public_path('images/categories/'.$filename);
//
//        Image::make($file)->encode("png")->resize(640, 360, function ($constraint) {
//            $constraint->aspectRatio();
//        })->save($location);

        Category::create([
            "name"=>$request->get("name"),
            "image"=>"image"
        ]);

        Session::flash("success","Category is created");

        return redirect()->route("category.index");

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
        $category=Category::findorfail($id);
        $this->validate($request,[
            "name"=>"required|unique:categories,name,".$category->id,
            "image"=>"nullable|mimes:jpg,jpeg,png"
        ]);
//        if($request->hasFile("image")){
//            $old_location=public_path($category->image);
//
//            if(file_exists($old_location))
//                unlink($old_location);
//
//            $file=$request->file("image");
//            $filename=uniqid(true).'.png';
//            $db_location='images/categories/'.$filename;
//
//            $location=public_path('images/categories/'.$filename);
//
//            Image::make($file)->encode("png")->resize(640, 360, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($location);
//                    $category->update([
//            "name"=>$request->get("name"),
//                        "image"=>$db_location
//        ]);

//        }else{
            $category->update([
                "name"=>$request->get("name")]);
//        }

        Session::flash("success","Category updated successfully");
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
        $category=Category::findorfail($id);
        $location=public_path($category->image);

        if(file_exists($location))
            unlink($location);

        $category->delete();

        Session::flash("success","Category has been deleted");

        return redirect()->back();
    }
}
