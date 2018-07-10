<?php

namespace App\Http\Controllers\Inventory;

use App\Model\Product;
use App\Model\StockRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductTransactionController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
      if($request->has("query")){
          $products=Product::select("id","name")->where("name","like",'%'.$request->get("query").'%')->orderBy("name","asc")->get();
      }else{
          $products=Product::select("id","name")->orderBy("name","asc")->get();
      }

        return view("inventory.transaction.product.index",compact("products"));
    }

    public function show($id){
        $product=Product::select("id","name","category_id","subcategory_id","code","image","price")->find($id);

       $records =StockRecord::select("size_name","user_name","bought_price","quantity","code","created_at")->where("product_id",$id)->get()->map(function ($item){
            return[

               "size"=> $item->size_name,
                "user_name"=>$item->user_name,
                "price"=>$item->bought_price,
                 "quantity"=>$item->quantity,
                "code"=>$item->code,
                "created_at"=>$item->created_at->toDateString()
            ];
        });
//  $records =StockRecord::select("size_name","user_name","bought_price","quantity","code","created_at")->where("product_id",$id)->get();


        return view("inventory.transaction.product.show",compact("records","product"));
    }


    public function search(Request $request){
        $id=$request->get("id");
        if($request->has("query")){
            $query=$request->get("query");

            $records=StockRecord::select("size_name","user_name","bought_price","quantity","code","created_at")
                ->where([["user_name","like",'%'.$query.'%'],["product_id",$id]])
                ->orWhere([["code","like",'%'.$query.'%'],["product_id",$id]])
                ->get()->map(function ($item){
                return[

                    "size"=> $item->size_name,
                    "user_name"=>$item->user_name,
                    "price"=>$item->bought_price,
                    "quantity"=>$item->quantity,
                    "code"=>$item->code,
                    "created_at"=>$item->created_at->toDateString()
                ];
            });

            return response()->json($records,200);
        }
        if($request->has("time")){
            $time=$request->get("time");
            $records=StockRecord::select("size_name","user_name","bought_price","quantity","code","created_at")
                ->where("product_id",$id)
                ->WhereDate("created_at","=",$time)
                ->get()->map(function ($item){
                return[

                    "size"=> $item->size_name,
                    "user_name"=>$item->user_name,
                    "price"=>$item->bought_price,
                    "quantity"=>$item->quantity,
                    "code"=>$item->code,
                    "created_at"=>$item->created_at->toDateString()
                ];
            });

            return response()->json($records,200);
        }


    }


}

