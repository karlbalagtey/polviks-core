<?php

use Illuminate\Database\Seeder;

class oAuthClientTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'secret' => 'secret1',
            'name' => 'polviks-react',
            'password_client' => true,
            'redirect' => 'http://polviks-core/auth/callback'
        ]);

        DB::table('oauth_clients')->insert([
            'secret' => 'secret2',
            'name' => 'polviks-vue',
            'password_client' => true,
            'redirect' => 'http://polviks-core/auth/callback'
        ]);

        DB::table('oauth_clients')->insert([
            'secret' => 'secret3',
            'name' => 'polviks-postman',
            'password_client' => true,
            'redirect' => 'http://polviks-core/auth/callback'
        ]);
    }
}
