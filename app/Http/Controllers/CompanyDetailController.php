<?php

namespace App\Http\Controllers;

use App\Model\CompanyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CompanyDetailController extends Controller
{
    public function index(){
        $company_details=CompanyDetail::first();

        return view("admin.company.detail",compact("company_details"));

    }

    public function store(Request $request){
//        dd($request->all());
        $this->validate($request,[
           "name"=>"required|max:50",
            "email"=>"required|max:40",
            "city"=>"required|max:50",
            "district"=>"required|max:50",
            "phone"=>"required|max:255",
            "cell"=>"required|max:255",
            "latitude"=>"required|numeric",
            "longitude"=>"required|numeric",
            "fb_link"=>"nullable|max:255",
            "twitter_link"=>"nullable|max:255",
            "linkedin_link"=>"nullable|max:255",
            "image"=>"nullable|mimes:jpg,jpeg,png",
            "short_detail"=>"required|max:255"
        ]);

        $company_details=CompanyDetail::first();
        $company_details->company_name=$request->get("name");
        if($request->hasFile("image")){
            $old_file=public_path($company_details->logo_url);

            if(file_exists($old_file))
                unlink($old_file);

            $file=$request->file("image");
            $name=uniqid(true).'.png';
            $db_location='images/company/'.$name;
            $file_path=public_path($db_location);
            Image::make($file)->encode("png")->save($file_path);

            $company_details->logo_url=$db_location;
        }

        $company_details->city=$request->get("city");

        $company_details->district=$request->get("district");
        $company_details->phone_no=$request->get("phone");
        $company_details->short_detail=$request->get("short_detail");
        $company_details->latitude=$request->get("latitude");
        $company_details->longitude=$request->get("longitude");
        $company_details->fb_link=$request->get("fb_link");
        $company_details->twitter_link=$request->get("twitter_link");
        $company_details->linked_in_link=$request->get("linkedin_link");
        $company_details->save();
        Session::flash("success","Details has been updated");

        return redirect()->back();
    }
    //
}
