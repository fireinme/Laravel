<?php

use Illuminate\Database\Seeder;
use \Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Model::unguard();
        $this->call(UsersSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(FollowerTableSeeder::class);
        Model::reguard();
    }
}
