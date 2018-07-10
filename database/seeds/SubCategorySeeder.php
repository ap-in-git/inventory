<?php

use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
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

            \App\Model\SubCategory::create([
                "name"=>$faker->name,
                "category_id"=>1
            ]);
        }
        for($i=0;$i<5;$i++){

            \App\Model\SubCategory::create([
                "name"=>$faker->name,
                "category_id"=>2
            ]);
        }
        for($i=0;$i<5;$i++){

            \App\Model\SubCategory::create([
                "name"=>$faker->name,
                "category_id"=>3
            ]);
        }
        for($i=0;$i<5;$i++){

            \App\Model\SubCategory::create([
                "name"=>$faker->name,
                "category_id"=>4
            ]);
        }
        for($i=0;$i<5;$i++){

            \App\Model\SubCategory::create([
                "name"=>$faker->name,
                "category_id"=>5
            ]);
        }
    }
}
