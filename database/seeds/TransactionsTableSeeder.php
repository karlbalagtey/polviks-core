<?php

use Illuminate\Database\Seeder;
use App\Models\ProductTransaction;
use App\Models\ServiceTransaction;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductTransaction::class, 200)->create();
        factory(ServiceTransaction::class, 200)->create();
    }
}
