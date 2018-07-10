<?php

namespace App\Http\Controllers;

use App\Model\CompanyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventory.index');
    }

    public function getAboutAdmin(){

        return view("admin.about.overview");
    }

    public function storeAboutOverview(Request $request){
//       dd($request->all());
           $this->validate($request,[
               "note"=>"required"
           ]);
           $details=CompanyDetail::first();
           $details->company_overview=$request->get("note");
           $details->save();

           Session::flash("success","Company overview updated successfully");

           return redirect()->back();

    }

    public function getCoreValue(){
        return view("admin.about.core");
    }

    public function storeCoreValue(Request  $request){

        $this->validate($request,[
            "note"=>"required"
        ]);
        $details=CompanyDetail::first();
        $details->core_value=$request->get("note");
        $details->save();

        Session::flash("success","Company overview updated successfully");

        return redirect()->back();
    }
}
