<?php

use App\Model\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i=0;$i<50;$i++){

            Product::create([
                "name"=>$faker->name,
                "category_id"=>1,
                "subcategory_id"=>$faker->numberBetween(1,5),
                "code"=>uniqid(true),
                "image"=>$faker->imageUrl(640,360),
                "status"=>$faker->numberBetween(1,3),
                "description"=>$faker->sentence(5),
                "price"=>$faker->numberBetween(100,1000)
            ]);
        }
        for($i=0;$i<50;$i++){

            Product::create([
                "name"=>$faker->name,
                "category_id"=>2,
                "subcategory_id"=>$faker->numberBetween(6,10),
                "code"=>uniqid(true),
                "image"=>$faker->imageUrl(640,360),
                "status"=>$faker->numberBetween(1,3),
                "description"=>$faker->sentence(5),
                "price"=>$faker->numberBetween(100,1000)
            ]);
        }
        for($i=0;$i<50;$i++){

            Product::create([
                "name"=>$faker->name,
                "category_id"=>3,
                "subcategory_id"=>$faker->numberBetween(11,15),
                "code"=>uniqid(true),
                "image"=>$faker->imageUrl(640,360),
                "status"=>$faker->numberBetween(1,3),
                "description"=>$faker->sentence(5),
                "price"=>$faker->numberBetween(100,1000)
            ]);
        }
        //
    }
}
