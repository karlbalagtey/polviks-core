<?php

use App\Category;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Service::class, 200)->create()->each(
        	function ($service) {
        		$categories = Category::all()->random(mt_rand(1, 5))->pluck('id');

        		$service->categories()->attach($categories);
        	}
        );
    }
}
