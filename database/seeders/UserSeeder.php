<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([

            'name'=> 'ahmed alaa',
            'email'=>'ah@gmail.com',
            'password'=>Hash::make('12345678'),
        ]);

        DB::table('users')->insert([
            'name'=>'rafiq alaa',
            'email'=>'ra@gmail.com',
            'password'=>Hash::make('12345678')
        ]);
    }
}
