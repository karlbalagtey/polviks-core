<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	[
                'role_type' => 'Superuser',
                'role_description' => 'Super User'
            ],

        	[
                'role_type' => 'Admin',
                'role_description' => 'System Administrator'
            ],

        	[
                'role_type' => 'Marketing',
        	    'role_description' => 'Marketing Polviks User'
            ],

        	[
                'role_type' => 'Staff',
        	    'role_description' => 'Staff Polviks User'
            ]
        ]);
    }
}
