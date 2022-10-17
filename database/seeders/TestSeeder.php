<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        /*$faker = Faker::create();
        foreach(range(1,400) as $index){
            DB::table('products')->insert([
                'name' => $faker->name,
                'category' => $faker->word,
                'description' => $faker->paragraph,
                'linkToProduct' => $faker->unique()->firstname(),
                'status' => 1,
            ]);
        }*/
    }
}
