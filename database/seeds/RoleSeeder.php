<?php

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new Role();
        $owner->name         = 'administrator';
        $owner->display_name = 'Supper User'; // optional
        $owner->description  = 'User having all role and permission'; // optional
        $owner->save();

        $user = User::where('name', '=', 'admin')->first();

        $user->attachRole($owner);
    }
}
