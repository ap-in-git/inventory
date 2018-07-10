<?php

namespace App\Http\Controllers\Inventory;

use App\Model\Quality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class QualityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qualities=Quality::select("id","name","code")->get();
        return view("inventory.quality.index",compact("qualities"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            "name"=>"required|max:255",
            "code"=>"required|unique:qualities,code"
        ]);

        Quality::create([
            "name"=>$request->get("name"),
            "code"=>$request->get("code")
        ]);

        Session::flash("success","Quality added successfully");

        return redirect()->back();
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
        $quality=Quality::findorfail($id);

        $this->validate($request,[
            "name"=>"required",
            "code"=>"required|unique:qualities,code,".$quality->id
        ]);

        $quality->update([
            "name"=>$request->get("name"),
            "code"=>$request->get("code")
        ]);


        Session::flash("success","Quality updated successfully");

        return redirect()->back();
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
