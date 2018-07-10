<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
          "name"=>"user",
          "email"=>"johndoe@gmail.com",
          "role"=>2,
          "password"=>Hash::make("password")
      ]);
      User::create([
          "name"=>"admin",
          "email"=>"ashokpoudel023@gmail.com",
          "role"=>1,
          "password"=>Hash::make("password")
      ]);

    }
}
