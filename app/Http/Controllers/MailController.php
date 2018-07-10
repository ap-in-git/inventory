<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProudctOrderReply;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{

    public function create(Request $request){
        $this->validate($request,[
            "email"=>"required|email"
        ]);


        return view("admin.email.create",[
           "email"=>$request->get("email")
        ]);
    }


    public function store(Request $request){
        $this->validate($request,[
           "email"=>"required|email",
           "message"=>"required"
        ]);

        Mail::to($request->get("email"))->send(new ProudctOrderReply($request->get("message"),$request->get("email")));

       Session::flash("success","You have successfully send the mail to ".$request->get("email"));

       return redirect()->to("/inventory/order-request");
    }
}
