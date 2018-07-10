<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Model\Stock;
use App\Model\Transaction;
use App\Model\UserTransaction;
use App\User;
use Illuminate\Http\Request;

class UserTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $is_search=false;
        $query=null;
        if($request->has("query")){
            $is_search=true;
            $query=$request->get("query");
            $users=  User::where(
                [['name', 'LIKE', '%'.$query.'%'],["role",2]]
            )->paginate(40);
        }else{
            $users=User::select("id","name","email")->where("role",2)->paginate(40);
        }


        return view("inventory.transaction.user.index",compact("users","is_search","query"));
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
            "user_id"=>"required|exists:users,id",
            "amount"=>"required|numeric",
            "type"=>"required",
            'note'=>"required"
        ]);
     $transaction= UserTransaction::create([
          "user_id"=>$request->get("user_id"),
          "amount"=>$request->get("amount"),
          "type"=>$request->get("type"),
          "note"=>$request->get("note")
      ]);

      return response()->json([
          "id"=>$transaction->id,
          "amount"=>$transaction->amount,
          "type"=>$transaction->type,
          "note"=>$transaction->note,
          "created"=>date("Y - m - d",strtotime($transaction->created_at))
      ],201);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param $user
     */
    public function show($id)
    {
     $user=User::findorfail($id);
     $ta=UserTransaction::where("user_id",$id)->orderBy("created_at","desc")->get();
     $transactions=$ta->map(function ($transaction){
         return [
             "id"=>$transaction->id,
             "amount"=>$transaction->amount,
             "type"=>$transaction->type,
             "note"=>$transaction->note,
             "created"=>date("Y - m - d",strtotime($transaction->created_at))

         ];
     });
     $total_paid=0;
     $total_paid_data=UserTransaction::select("amount")->where([["user_id",$user->id],["type","paid"]])->get();
     foreach ($total_paid_data as $d){
         $total_paid=$total_paid+$d->amount;
     }
     $total_due=0;
     $total_due_data=UserTransaction::select("amount")->where([["user_id",$user->id],["type","due"]])->get();

     foreach ($total_due_data as $d){
         $total_due=$total_due+$d->amount;
     }


     $user_stock_code=Stock::select("code")->where("user_id",$id)->get()->toArray();
     $user_sell_transactions=Transaction::whereIn("code",$user_stock_code)->get();
        return view("inventory.transaction.user.show",compact("user","transactions","total_paid","total_due","user_sell_transactions"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\UserTransaction  $userTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTransaction $userTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\UserTransaction  $userTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTransaction $userTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\UserTransaction  $userTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTransaction $userTransaction)
    {
        //
    }
}
