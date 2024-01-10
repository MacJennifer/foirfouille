<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'lastname' => 'utilisateur',
            'firstname' => 'test',
            'adress' => '1 rue de l\'alcool',
            'zipcode' => 78000,
            'city' => 'Paris',
            'email' => 'utilisateur@gmail.com',
            'password' => '14789632',
            'remember_token' => Str::random(10),
            'role_id' => 2
        ]);
       User::factory(8)->create();
}
}