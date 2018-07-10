<?php

use App\Model\Product;
use App\Model\SubCategory;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Product::truncate();
        SubCategory::truncate();
        \App\Model\Category::truncate();

        User::truncate();


        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubCategorySeeder::class);
        $this->call(ProductSeeder::class);

        DB::statement("SET foreign_key_checks=1");
//         $this->call(CategorySeeder::class);
//         $this->call(ProductSeeder::class);
//         $this->call(StockSeeder::class);
    }
}
