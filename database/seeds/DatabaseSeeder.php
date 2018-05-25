<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = [
        'users',
        'agents',
        'customers',
        'products',
        'services',
        'roles',
        'transactions'
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        DB::table('category_product')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $this->call(UsersTableSeeder::class);
        $this->call(AgentsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
        // $this->call(oAuthClientTestSeeder::class);

        Model::reguard();
    }
}
