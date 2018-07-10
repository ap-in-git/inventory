<?php

namespace App\Http\Controllers;

use App\Model\CompanyLeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class LeaderShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers=CompanyLeader::all();

        return view("admin.leader.index",compact("workers"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.leader.create");
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
        //

//        dd($request->all());
        $this->validate($request,[
           "name"=>"required|max:50",
            "position"=>"required|max:200",
            "image"=>"required|mimes:jpg,jpeg,png",
            "saying"=>"required|max:1000",
            "view_position"=>"required|numeric"
        ]);

        $worker=new CompanyLeader();
        $worker->name=$request->get("name");
        $worker->position=$request->get("position");
        $worker->saying=$request->get("saying");
        $worker->view_position=$request->get("view_position");
        $file=$request->file("image");
        $db_location='images/workers'.uniqid(true).'.png';
        $file_location=public_path($db_location);
        Image::make($file)->encode("png")->resize(200,200)->save($file_location);

        $worker->image=$db_location;
        $worker->save();
        Session::flash("success","New profile has been created");

        return redirect()->route("admin.worker.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $worker=CompanyLeader::findorfail($id);
        return view("admin.leader.edit",compact("worker"));
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
        $worker=CompanyLeader::findorfail($id);
        $this->validate($request,[
            "name"=>"required|max:50",
            "position"=>"required|max:200",
            "image"=>"nullable|mimes:jpg,jpeg,png",
            "saying"=>"required|max:1000",
            "view_position"=>"required|numeric"
        ]);

        $worker->name=$request->get("name");
        $worker->position=$request->get("position");
        $worker->saying=$request->get("saying");
        $worker->view_position=$request->get("view_position");

        if($request->hasFile("image")){

            $old_file=public_path($worker->image);

            if(file_exists($old_file))
                unlink($old_file);

            $file=$request->file("image");
            $db_location='images/workers'.uniqid(true).'.png';
            $file_location=public_path($db_location);
            Image::make($file)->encode("png")->resize(200,200)->save($file_location);

            $worker->image=$db_location;
        }
        $worker->save();
        Session::flash("success","Profile has been updated");
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
        $worker=CompanyLeader::findorfail($id);
        $file_path=public_path($worker->image);

        if(file_exists($worker)){
            unlink($file_path);
        }

        $worker->delete();

        Session::flash("success","Worker has been deleted");

        return redirect()->back();
    }
}
