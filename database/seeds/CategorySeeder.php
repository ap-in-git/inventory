<?php

use App\Model\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i=0;$i<5;$i++){

            Category::create([
                "name"=>$faker->name,
                "category_id"=>null,
                "image"=>$faker->imageUrl(640,360)
            ]);
        }
    }
}
