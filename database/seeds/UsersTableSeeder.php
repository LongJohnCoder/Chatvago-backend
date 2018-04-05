<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user           = new User();
        $user->name     = 'Super Admin';
        $user->email    = 'work@tier5.us';
        $user->password = Hash::make(config('app.superadmin.default_password'));
        $user->role     = '1';
        $user->save();
    }
}
