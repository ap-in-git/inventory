<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders=Slider::all();
        return view("admin.slider.index",compact("sliders"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.slider.create");
        //
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
            "image"=>"required|image",
            "title"=>'required|max:100',
        ]);

        $slider=new Slider();
        $slider->name=$request->get("title");
        $dblocation=uniqid(true).'.png';
        $location=public_path('images/slider/'.$dblocation);
        $file=$request->file("image");
        Image::make($file)->encode("png")->save($location);
        $slider->image_url=$dblocation;
        $slider->save();

        Session::flash("success","New slider has been created");

        return redirect()->route("admin.slider.index");
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
        $slider=Slider::findorfail($id);
        return view("admin.slider.edit",compact("slider"));
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

        $slider=Slider::findorfail($id);
        $this->validate($request,[
            "title"=>"required|max:100",
           "image"=>"nullable|image"
        ]);

        $slider->name=$request->get("title");
        if($request->hasFile("image")){
            $old_location=public_path("images/slider/".$slider->image_url);
            if(file_exists($old_location))
                unlink($old_location);

            $dblocation=uniqid(true).'.png';
            $location=public_path('images/slider/'.$dblocation);
            $file=$request->file("image");
            Image::make($file)->encode("png")->save($location);
            $slider->image_url=$dblocation;
        }

        $slider->save();
        Session::flash("success","Slider has been updated");

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
        $slider=Slider::findorfail($id);
        $file_location=public_path("/images/slider/".$slider->image_url);
        if(file_exists($file_location))
            unlink($file_location);

        $slider->delete();
        Session::flash("success","Slider has been deleted");


        return redirect()->back();
    }
}
