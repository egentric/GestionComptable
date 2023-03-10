<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create([        
        'pseudo' => 'Tricus',
        'email' => 'infogentric@gmail.com',
        'firstname' =>'Erwan',
        'name' =>'Gentric',
        'password' => Hash::make('AdminRoot'),
        'email_verified_at' => now(),
        'remember_token' => Str::random(10) 
        ]);

        User::Create([        
            'pseudo' => 'Titi',
            'email' => 'egentric@gmail.com',
            'firstname' =>'Tiphaine',
            'name' =>'Gentric',
            'password' => Hash::make('AdminRoot'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10) 
            ]);
    }
}
