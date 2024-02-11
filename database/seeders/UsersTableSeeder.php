<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'u1', 'email' => 'u1@example.com', 'password' => bcrypt('password')],
            ['name' => 'u2', 'email' => 'u2@example.com', 'password' => bcrypt('password')],
            ['name' => 'u3', 'email' => 'u3@example.com', 'password' => bcrypt('password')],
            ['name' => 'u4', 'email' => 'u4@example.com', 'password' => bcrypt('password')],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $u1 = User::where('email', 'u1@example.com')->first();
        $u2 = User::where('email', 'u2@example.com')->first();
        $u3 = User::where('email', 'u3@example.com')->first();
        $u4 = User::where('email', 'u4@example.com')->first();

        $u1->following()->attach([$u2->id, $u3->id]);
        $u2->following()->attach([$u3->id, $u4->id]);
        $u3->following()->attach([$u4->id, $u1->id]);
        $u4->following()->attach([$u1->id, $u2->id]);
    }
}
