<?php

namespace App\Http\Controllers;

use App\Mail\ProductOrderMail;
use App\Model\Product;
use App\Model\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ProductOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=ProductOrder::with("product:id,name")->orderBy("created_at","desc")->paginate(40);
        return view("inventory.product.order",compact("orders"));
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
            "id"=>"required|exists:products,id",
            "name"=>"required|max:255",
            "email"=>"required|email|max:255",
            "phone"=>"required|max:255",
            "quantity"=>"required|numeric",
            "note"=>"required|max:255",

        ]);

        ProductOrder::create([
            "product_id"=>$request->input("id"),
            "name"=>$request->input("name"),
            "email"=>$request->input("email"),
            "phone"=>$request->input("phone"),
            "quantity"=>$request->input("quantity"),
            "note"=>$request->input("note"),
        ]);
        $product=Product::find($request->get("id"));
        Mail::to("info@homecreation.com.np")->send(new ProductOrderMail($product,[
            "name"=>$request->get("name"),
            "email"=>$request->get("email"),
            "phone"=>$request->get("phone"),
            "quantity"=>$request->get("quantity"),
            "note"=>$request->get("note")
        ]));

        Session::flash("success","Your order was sent successfully. We will contact you soon . ");

        return redirect()->back();
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

        $order=ProductOrder::findorfail($id);
        $order->seen=1;
        $order->save();
        return response()->json([
            "id"=>$order->id,
           "product_name"=>$order->product->name,
            "name"=>$order->name,
            "email"=>$order->email,
            "phone"=>$order->phone,
            "quantity"=>$order->quantity,
            "note"=>$order->note
        ],200);
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
        $order=ProductOrder::findorfail($id);
        $order->delete();
        Session::flash("success","Product order was deleted successfully");
        return redirect()->back();
        //
    }
}
