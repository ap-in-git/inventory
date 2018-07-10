<?php

namespace App\Http\Controllers;

use App\Model\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages=ContactMessage::all();
        return view("admin.contact.index",compact("messages"));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message=ContactMessage::findorfail($id);
        $message->seen=1;
        $message->save();
        return response()->json([
            "id"=>$message->id,
            "seen"=>$message->seen,
            "name"=>$message->name,
            "email"=>$message->email,
            "phone"=>$message->phone,
            "message"=>$message->message,
            "created_at"=>$message->created_at->diffForHumans()
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $message=ContactMessage::findorfail($id);
    $message->delete();
    Session::flash("success","Message has been deleted successfully");

    return redirect()->back();
    }
}
