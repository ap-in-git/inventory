<?php

use Illuminate\Support\Facades\Route;

Route::get("/", "Front\PageController@getIndex");
Route::get("/home", "HomeController@index");

Route::middleware("auth")->prefix("/inventory")->group(function () {
    Route::resource("/category", "Inventory\CategoryController");
    Route::resource("/subcategory", "Inventory\SubCategoryController");

    Route::get("/order-request", "ProductOrderController@index")->name("order.index");
    Route::get("/product-order/{id}", "ProductOrderController@show")->name("order.show");
    Route::delete("/order/{id}", "ProductOrderController@destroy")->name("order.delete");
    Route::resource("/product", "Inventory\ProductController", ['except'=>['show']]);

    Route::resource('/size', "Inventory\SizeController", ['except'=>['create','edit','show']]);

    Route::get("/stock-history", "Inventory\StockController@history")->name("stock.history");
    Route::put("/stock-update/{id}", "Inventory\StockController@insert")->name("stock.insert");
    Route::resource("/stock", "Inventory\StockController");

    Route::get("/transaction-cancel/{id}", "Inventory\TransactionController@cancel")->name("transaction.cancel");

    Route::get("/transaction/product", "Inventory\ProductTransactionController@index")->name("product.transaction.index");
    Route::get("/transaction/product-search", "Inventory\ProductTransactionController@search");
    Route::get("/transaction/product/{id}", "Inventory\ProductTransactionController@show");

    Route::get("/transaction/report", "Inventory\TransactionController@history")->name("transaction.report");
    Route::get("/sell-history", "Inventory\TransactionController@index")->name("transaction.index");
    Route::resource("/transaction", "Inventory\TransactionController", ['except'=>['show','edit','index']]);


    Route::get("/user-transaction", "Inventory\UserTransactionController@index")->name("user.transaction.index");
    Route::post("/user-transaction", "Inventory\UserTransactionController@store");
    Route::get("/user-transaction/{user}", "Inventory\UserTransactionController@show");

    Route::resource("/quality", "Inventory\QualityController");
});

Route::middleware("auth")->prefix("/admin")->as("admin.")->group(function () {
    Route::resource("/slider", "Front\SliderController", [
       "except"=>[
           'show'
       ]
   ]);

    Route::resource("/worker", "LeaderShipController", [
       'except'=>'show'
   ]);


    Route::resource("/testimonial", "Front\TestimonialController");

    Route::get("/about-us", "HomeController@getAboutAdmin")->name("about");
    Route::get("/core-value", "HomeController@getCoreValue")->name("core");
    Route::post("/core-value", "HomeController@storeCoreValue")->name("core.store");
    Route::post("/about-overview", "HomeController@storeAboutOverview")->name("about.overview");
    Route::get("/contact", "ContactController@index")->name("contact.index");
    Route::get("/message/{id}", "ContactController@show");
    Route::delete("/message/{id}", "ContactController@destroy");

    Route::get("/company-detail", "CompanyDetailController@index")->name("company.detail");
    Route::post("/company-detail", "CompanyDetailController@store")->name("company.detail.store");

    Route::get("/send-mail","MailController@create");
    Route::post("/send-mail","MailController@store");
});

Route::get("/about", "Front\PageController@getAbout");

Route::get("/products", "Front\ProductController@index");
Route::get("/product/{id}", "Front\ProductController@show")->name("public.product.show");

Route::get("/search", "Front\ProductController@search");
Route::get("/categories", "Front\CategoryController@index");
Route::get("/subcategory/{id}", "Front\PageController@getProductsBySubCategory");

Route::post("/product-order", "ProductOrderController@store")->name("order.store");

Route::resource("/user", "UserController")->middleware("auth");

Route::get("/contact", "Front\PageController@getContact");
Route::post("/contact", "Front\PageController@storeContact");

Route::get("/login","Auth\LoginController@showLoginForm")->name("login");
Route::post("/login","Auth\LoginController@login");
Route::post("/logout","Auth\LoginController@logout")->name("logout");


