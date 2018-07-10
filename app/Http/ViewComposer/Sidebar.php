<?php
namespace App\Http\ViewComposer;

use App\Model\Category;
use Illuminate\View\View;

class Sidebar{

    public function compose(View $view){

        $categories=Category::select("id","name")->get();

        $view->with("sidebar_categories",$categories);
    }
}