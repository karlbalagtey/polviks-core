<?php

use App\Category;
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
        factory(App\Product::class, 200)->create()->each(
        	function ($product) {
        		$categories = Category::all()->random(mt_rand(1, 5))->pluck('id');

        		$product->categories()->attach($categories);
        	}
        );
    }
}
