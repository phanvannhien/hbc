<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(ContriesSeeder::class);
//        $this->call(ContinentsSeeder::class);
//        $this->call(UsersTableSeeder::class);
//        $this->call(LanguageSeeder::class);
//        $this->call(CitiesSeeder::class);
//        $this->call( RoleSeeder::class );
        $this->call(AdminSeeder::class);
    }
}
