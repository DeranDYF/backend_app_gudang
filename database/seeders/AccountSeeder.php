<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = [
            [
                'username' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'level' => 'admin',
                'password' => bcrypt('admin1221'),
            ],
            [
                'username' => 'user',
                'name' => 'User',
                'email' => 'user@gmail.com',
                'level' => 'user',
                'password' => bcrypt('user1221'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
