<?php

namespace App\Http\Controllers\Front;

use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->validate($request, [
        "sort"=>"nullable|in:latest,oldest,alpha_desc,alpha_asc",
        "sub"=>"nullable|numeric"
      ]);
        $sort=$request->get("sort");
        $sub=$request->get("sub");

        if (!$request->has("sub")&&!$request->has("sort")) {
            $products=Product::select("id", "name", "image", "price")->orderBy("name", "asc")->paginate(9);
        } else {
            if ($sub==0) {
                switch ($sort) {
                case 'latest':
                $products=Product::select("id", "name", "image", "price")->orderBy("created_at", "desc")->paginate(9);
                    break;
                case 'oldest':
                $products=Product::select("id", "name", "image", "price")->orderBy("created_at", "asc")->paginate(9);
                    break;
                case 'alpha_desc':
                $products=Product::select("id", "name", "image", "price")->orderBy("name", "desc")->paginate(9);
                    break;
                case 'alpha_asc':
                $products=Product::select("id", "name", "image", "price")->orderBy("name", "asc")->paginate(9);
                    break;
                default:
                $products=Product::select("id", "name", "image", "price")->orderBy("name", "asc")->paginate(9);
            }
            } else {
                switch ($sort) {
                case 'latest':
                $products=Product::select("id", "name", "image", "price")->where("subcategory_id", $sub)->orderBy("created_at", "desc")->paginate(9);
                    break;
                case 'oldest':
                $products=Product::select("id", "name", "image", "price")->where("subcategory_id", $sub)->orderBy("created_at", "asc")->paginate(9);
                    break;
                case 'alpha_desc':
                $products=Product::select("id", "name", "image", "price")->where("subcategory_id", $sub)->orderBy("name", "desc")->paginate(9);
                    break;
                case 'alpha_asc':
                $products=Product::select("id", "name", "image", "price")->where("subcategory_id", $sub)->orderBy("name", "asc")->paginate(9);
                    break;
                default:
                $products=Product::select("id", "name", "image", "price")->orderBy("name", "asc")->paginate(9);

            }
            }
        }
        return view("public.product.index", compact("products"));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $product=Product::findorfail($id);
        $related_products=Product::inRandomOrder()->take(4)->get();
        return view("public.product.show", compact("product", "related_products"));
    }

    public function search(Request $request)
    {
        $this->validate($request,[
            "q"=>"required"
        ]);
$query=$request->get("query");
        $products=Product::select("id","name","price","image")
         ->where("name",'like','%'.$query.'%')
        ->orderBy("created_at","desc")->paginate(9);

        return view("public.product.search",compact("products","query"));

    }
    //
}
