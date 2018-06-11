<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach (range(1, 5) as $i) {
	        Product::create([
	            'user_id' => 1,
	            'name' => "Product $i",
	            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
	            'price' => mt_rand((100 * 100), (1000 * 100)) / 100,
	            'discount' => 0,
	            'number_of_stocks' => rand(10,30)
	        ]);
	    }
    }
}
