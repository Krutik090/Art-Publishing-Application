<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
            'name'=> 'Super Admin',
            'email' => 'krutikthakar2539@gmail.com',
            'password' => Hash::make('password'),
            'user_type' => 'admin',
            ],
            [
                'name'=> 'krutik thakar',
                'email' => 'dipeshthakar2002@gmail.com',
                'password' => Hash::make('password'),
                'user_type' => 'user',
            ]
        ],

    );
    }
}
