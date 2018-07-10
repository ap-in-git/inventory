<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Requests\OrderCreateRequest;
use App\Model\Category;
use App\Model\Product;
use App\Model\Quality;
use App\Model\Size;
use App\Model\Stock;
use App\Model\StockRecord;
use App\Model\UserTransaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   $query=null;
        $has_query=false;
        if($request->has("query")){
            $query=$request->get("query");
              $has_query=true;
            if($request->ajax()){
                $products=  Product::where(
                    'name', 'LIKE', '%'.$query.'%'
                )->pluck("id");
                $old_stocks=  Stock::where(
                    'code', 'LIKE', '%'.$query.'%'
                )->orWhereIn("product_id",$products)->
                take(40)->get();

                $stocks=$old_stocks->map(function ($old_stock){
                  return [
                      "id"=>$old_stock->id,
                      "code"=>$old_stock->code,
                      "name"=>$old_stock->product->name,
                      "size"=>$old_stock->size->name,
                      "quantity"=>$old_stock->quantity,
                      "price"=>$old_stock->price
                  ];
                });


                return response()->json($stocks,200);
            }else{
                $products=  Product::where(
                    'name', 'LIKE', '%'.$query.'%'
                )->pluck("id");
                $stocks=  Stock::where(
                    'code', 'LIKE', '%'.$query.'%'
                )->orWhereIn("product_id",$products)->
                paginate(40);
            }

        }else{
            $stocks=Stock::orderBy("created_at","desc")->paginate(40);
        }


        return view("inventory.stock.index",compact("stocks","has_query","query"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::select("id","name")->orderBy("name","asc")->get();
        $categories=Category::select("id","name")->orderBy("name","asc")->get();
        $sizes=Size::select("id","name")->get();

        return view("inventory.stock.create",compact("users","categories","sizes"));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderCreateRequest $request)
    {

        if($request->get("selling_price")<=$request->get("price"))
        {
            Session::flash("warning","Selling price should be greater than or equal to bought price");

            return redirect()->back();
        }
        Stock::create([
            "product_id"=>$request->get("product"),
            "size_id"=>$request->get("size"),
            "user_id"=>$request->get("user"),
            "code"=>$request->get("code"),
            "price"=>$request->get("selling_price"),
            "quantity"=>$request->get("stock"),
            "image"=>'http://lorempixel.com/300/200/',
            "bought_price"=>$request->get("price"),
            "quality"=>$request->get("quality")
        ]);
        $product=Product::findorfail($request->get("product"));
        $size=Size::findorfail($request->get("size"));
        $user=User::findorfail($request->get("user"));
        StockRecord::create([
            "product_id"=>$product->id,
            "product_name"=>$product->name,
            "size_id"=>$size->id,
            "size_name"=>$size->name,
            "user_id"=>$user->id,
            "user_name"=>$user->name,
            "quantity"=>$request->get("stock"),
            "code"=>$request->get("code"),
            "bought_price"=>$request->get("price"),
            "image"=>'http://lorempixel.com/300/200/',
        ]);

        UserTransaction::create([
            "user_id"=>$user->id,
            "amount"=>$request->get("stock")*$request->get("price"),
            "type"=>'due',
            "note"=>$product->name.' ('.$size->name.') added of quantity '.$request->get("stock").' at Rs '.$request->get("price")

        ]);
        Session::flash("success","Stock is created successfully");
        return redirect()->route("stock.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock=Stock::findorfail($id);
        return response()->json([
            "id"=>$id,
            "name"=>$stock->product->name,
            "size"=>$stock->size->name,
            "price"=>$stock->price,
            "quantity"=>$stock->quantity
        ]);
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
        $stock=Stock::findorfail($id);
        $users=User::select("id","name")->orderBy("name","asc")->get();
        $categories=Category::select("id","name")->orderBy("name","asc")->get();
        $sizes=Size::select("id","name")->get();
        $qualities=Quality::select("id","name")->get();

        return view("inventory.stock.edit",compact("stock","users","categories","sizes","qualities"));
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

        $stock=Stock::findorfail($id);
       $this->validate($request,[
           "category"=>"required|exists:categories,id",
           "product"=>"required|exists:products,id",
           "user"=>"required|exists:users,id",
           "bought_price"=>"required|numeric",
           "price"=>"required|numeric",
           "size"=>"required|exists:sizes,id",
           "code"=>"required|unique:stocks,code,".$stock->id
       ]);
       $stock->update([
           "product_id"=>$request->get("product"),
           "user_id"=>$request->get("user"),
           "code"=>$request->get("code"),
           "price"=>$request->get("price"),
           "image"=>'http://lorempixel.com/300/200/',
           "bought_price"=>$request->get("bought_price")
       ]);
       Session::flash("success","Stock updated successfully");
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
        $stock=Stock::findorfail($id);
        $stock->delete();
        Session::flash("success","Stock deleted successfully");

        return redirect()->back();
        //
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insert(Request $request, $id){

        $this->validate($request,[
            "type"=>"required|in:0,1,2",
            "quantity"=>"required|numeric",
            "bought_price"=>"required|numeric",
            "description"=>"nullable|max:255"
        ]);
        $stock=Stock::findorfail($id);
        $user=User::findorfail($stock->user_id);
        $type=$request->get("type");
        if($type==1){
            $type=1;
            $quantity=$stock->quantity+$request->get("quantity");
            UserTransaction::create([
                "user_id"=>$user->id,
                "amount"=>$request->get("quantity")*$request->get("bought_price"),
                "type"=>'due',
                "note"=>$stock->product->name.' ('.$stock->size->name.') added of quantity '.$request->get("quantity").' at Rs'.$request->get("price")
            ]);

        }else if($type==0){

            if($request->get("quantity")>$stock->quantity){
                Session::flash("warning","Not enough stock no remove");
                return redirect()->back();
            }else{
                $quantity=$stock->quantity-$request->get("quantity");
            }
        }else{
            $quantity=$stock->quantity-$request->get("quantity");
            $amount=$request->get("quantity")*$request->get("bought_price");
            UserTransaction::create([
                "user_id"=>$user->id,
                "amount"=>$amount,
                "type"=>"Product return",
                "note"=>'Product returned of name '.$stock->product->name.' of total price Npr'.$amount
            ]);

        }


        StockRecord::create([
            "product_id"=>$stock->product_id,
            "product_name"=>$stock->product->name,
            "size_id"=>$stock->size_id,
            "size_name"=>$stock->size->name,
            "user_id"=>$user->id,
            "user_name"=>$user->name,
            "quantity"=>$request->get("quantity"),
            "code"=>$stock->code,
            "bought_price"=>$request->get("bought_price"),
            "image"=>'http://lorempixel.com/300/200/',
            "type"=>$type,
            "notes"=>$request->get("description")
        ]);

        $stock->update([
            "bought_price"=>$request->get("bought_price"),
            "quantity"=>$quantity
        ]);

        Session::flash("success","Stock has been updated");

        return redirect()->back();


    }


    public function history(Request $request){
        $has_query=false;
        $query=null;
        if($request->has("query")){
            $query=$request->get("query");
            $has_query=true;


                $stocks=  StockRecord::where(
                    'code', 'LIKE', '%'.$query.'%'
                )
                ->orWhere('product_name', 'LIKE', '%'.$query.'%')
                ->orWhere('user_name', 'LIKE', '%'.$query.'%')
                ->paginate(40);


        }else{
            $stocks=StockRecord::orderBy("created_at","desc")->paginate(40);
        }

        if(!$request->ajax())
            return view("inventory.stock.history",compact("stocks","has_query","query"));


    }

}
