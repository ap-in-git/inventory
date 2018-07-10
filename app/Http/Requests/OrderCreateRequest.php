<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {


        $validation_array= [
            "category"=>"required|exists:categories,id",
            "product"=>"required|exists:products,id",
            "user"=>"required|exists:users,id",
            "selling_price"=>"required|numeric",
            "stock"=>"required|numeric",
            "size"=>"required|exists:sizes,id",
            "code"=>"required|unique:stocks,code"

        ];


        return $validation_array;
    }

}
