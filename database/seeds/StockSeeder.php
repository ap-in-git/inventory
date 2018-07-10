<?php

use App\Model\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i=0;$i<500;$i++){

            Stock::create([
                "product_id"=>$faker->numberBetween(2,50),
                "size_id"=>$faker->numberBetween(1,3),
                "user_id"=>1,
                "code"=>uniqid(true),
                "price"=>$faker->randomNumber(),
                "quantity"=>$faker->numberBetween(10,100),
                "image"=>'http://lorempixel.com/300/200/',
                "bought_price"=>$faker->numberBetween(10,100)


            ]);
        }

    }
}
