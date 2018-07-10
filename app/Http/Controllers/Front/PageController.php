<?php

namespace App\Http\Controllers\Front;

use App\Model\CompanyLeader;
use App\Model\ContactMessage;
use App\Model\Product;
use App\Model\Slider;
use App\Model\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Model\SubCategory;

class PageController extends Controller
{
    public function getContact()
    {
        return view("public.pages.contact");
    }

    public function getIndex()
    {
        $sliders=Slider::select("id", "name", "image_url")->get();
        $top_products=Product::select("id", "name", "price", "image")->where("status", 1)->inRandomOrder()->take(4)->get();
        $featured=Product::select("id", "name", "price", "image")->where("status", 2)->inRandomOrder()->take(4)->get();
        $testimonials=Testimonial::select("id", "name", "position", "company", "image_url","text")->inRandomOrder()->take(4)->get();
        return view("public.index", compact("sliders", "top_products", "featured", "testimonials"));
    }


    public function storeContact(Request $request)
    {
        $this->validate($request, [
            'name'=>"required|max:50",
            'email'=>"required|email",
            'phone'=>'required|max:20',
            'message'=>"required|max:200"
        ]);

        ContactMessage::create([
            "name"=>$request->get("name"),
            "email"=>$request->get("email"),
            "phone"=>$request->get("phone"),
            "message"=>$request->get("message")
        ]);

        Session::flash("success", "Your message was send successfully !. We will contact you soon");

        return redirect()->back();
    }

    public function getAbout()
    {
        $workers=CompanyLeader::orderBy("view_position", "asc")->get();
        return view("public.pages.about", compact("workers"));
    }
}
