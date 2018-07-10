<?php

namespace App\Http\Controllers\Inventory;

use App\Model\Stock;
use App\Model\StockRecord;
use App\Model\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

//
//       if($request->has("per_page")) {
//
//           $sort = $request->get("sort");
//           $sort_array = explode("|", $sort);
//           if ($request->sort != "") {
//               $transactions = Transaction::select("product_name","code","user_name","size","quantity","bought_price","sold_price","created_at")->orderBy($sort_array["0"], $sort_array[1])->paginate(40);
//
//
//           }else{
//               $transactions = Transaction::select("product_name","code","size","user_name","quantity","bought_price","sold_price","created_at")->paginate(40);
//           }
//
//
//           return response()->json($transactions,200);
//       }

          $has_query=false;
        

        if($request->has("query")){
            $query=$request->get("query");
            $has_query=true;


            $transactions=  Transaction::where(
                'code', 'LIKE', '%'.$query.'%'
            )
                ->orWhere('product_name', 'LIKE', '%'.$query.'%')
                ->orWhere('bill_no', 'LIKE', '%'.$query.'%')
                ->orWhere('user_name', 'LIKE', '%'.$query.'%')
                ->orderBy("created_at","desc")
                ->paginate(40);


        }else{
            $transactions=Transaction::orderBy("created_at","desc")->paginate(40);
        }
        return view("inventory.transaction.index",compact("transactions","has_query","query"));


        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("inventory.transaction.create");
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
            "stock_id"=>"required|exists:stocks,id",
            "quantity"=>"required",
            "price"=>"required",
            "billNo"=>"required"
        ]);
        $stock=Stock::findorfail($request->get("stock_id"));
        if($request->get("quantity")>$stock->quantity)
            return;

        $user=User::findorfail($stock->user_id);

        $transaction=new Transaction();
        $transaction->product_name=$stock->product->name;
        $transaction->code=$stock->product->code;
        $transaction->quantity=$request->get("quantity");
        $transaction->discount=0;
        $transaction->sold_price=$request->get("price");
        $transaction->bought_price=$stock->bought_price;
        $transaction->bill_no=$request->get("billNo");
        $transaction->code=$stock->code;
        $transaction->size=$stock->size->name;
        $transaction->user_id=$stock->user_id;
        $transaction->user_name=$user->name;
        $transaction->save();
        $stock->quantity=$stock->quantity-$request->get("quantity");

        $stock->save();

        return response()->json([$stock->id,$stock->quantity],200);
    }


   public function cancel($id){
    $transaction=Transaction::findorfail($id);
    if($transaction->void==1)
        abort(404);

    $transaction->void=1;
    $transaction->save();
    Session::flash("success","Bill has been cancelled");

    return redirect()->back();
   }


   public function history(Request $request){
       if($request->has("start")){
           $start=date("Y-m-d",strtotime($request->get("start")));
           $start=new Carbon($request->get("start"));

           $end=new Carbon($request->get("end"));
           $end=$end->addDay()->toDateTimeString();

           $records=StockRecord::select("product_name","size_name","user_name","bought_price","quantity","code","created_at")
                   ->whereBetween("created_at",[$start,$end])
               ->get()->map(function ($item){
                   return[
                       "product_name"=>$item->product_name,
                       "size_name"=> $item->size_name,
                       "user_name"=>$item->user_name,
                       "bought_price"=>$item->bought_price,
                       "quantity"=>$item->quantity,
                       "code"=>$item->code,
                       "created_at"=>$item->created_at->toDateString()
                   ];
               });
           return response()->json($records,200);
       }

       $records=StockRecord::select("product_name","size_name","user_name","bought_price","quantity","code","created_at")->whereDate("created_at",Carbon::today()->toDateTimeString())->get()->map(function ($item){
           return[
               "product_name"=>$item->product_name,
               "size_name"=> $item->size_name,
               "user_name"=>$item->user_name,
               "bought_price"=>$item->bought_price,
               "quantity"=>$item->quantity,
               "code"=>$item->code,
               "created_at"=>$item->created_at->toDateString()
           ];
       });;

       return view("inventory.transaction.report.index",compact("records"));


   }

}
