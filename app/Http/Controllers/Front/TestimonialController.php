<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials=Testimonial::select("id","name","position","company","image_url")->orderBy("created_at","desc")->get();
        return view("admin.testimonial.index",compact("testimonials"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("admin.testimonial.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $testimonial=new Testimonial();
        $testimonial->name=$request->get("name");
        $testimonial->position=$request->get("position");
        $testimonial->company=$request->get("company");
        $testimonial->text=$request->get("text");
        $name=uniqid(true).'.png';
        $location='images/testimonial/'.$name;
        $file_path=public_path($location);

        Image::make($request->file("image"))->encode("png")->save($file_path);
        $testimonial->image_url=$location;
        $testimonial->save();

        Session::flash("success","Testimonial added successfully");

        return redirect()->route("admin.testimonial.index");
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
        $testimonial=Testimonial::findorfail($id);
        return view("admin.testimonial.edit",compact("testimonial"));

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
        //
        $testimonial=Testimonial::findorfail($id);
        $this->validate($request,[
            "image"=>"nullable|mimes:jpg,jpeg,png",
            "company"=>"required|max:50",
            "position"=>"required|max:50",
            "name"=>"required|max:100"
        ]);

        $testimonial->name=$request->get("name");
        $testimonial->position=$request->get("position");
        $testimonial->company=$request->get("company");
        $testimonial->text=$request->get("text");
        if($request->hasFile("image")){
            $old_file=public_path($testimonial->image_url);

            if(file_exists($old_file))
                unlink($old_file);


            $name=uniqid(true).'.png';
            $location='images/testimonial/'.$name;
            $file_path=public_path($location);

            Image::make($request->file("image"))->encode("png")->save($file_path);
            $testimonial->image_url=$location;
        }
        $testimonial->save();
        Session::flash("success","Testimonial edited successfully");

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
        $testimonial=Testimonial::findorfail($id);

        $file_path=public_path($testimonial->image_url);

        if(file_exists($file_path))
            unlink($file_path);


        $testimonial->delete();

        Session::flash("success","Testimonial has been deleted");
        return redirect()->back();
        //
    }


}
