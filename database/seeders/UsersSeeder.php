<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name="Abdelrahman";
        $user->email="abdelrahman@gmail.com";
        $user->password= Hash::make('abdelrahman');
        $user->save();

        $user = new User();
        $user->name="Sakr";
        $user->email="sakr@gmail.com";
        $user->password= Hash::make('sakr');
        $user->save();
    }
}
