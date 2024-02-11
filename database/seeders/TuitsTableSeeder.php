<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tuit;

class TuitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 1; $i <= 3; $i++) {
                Tuit::create([
                    'user_id' => $user->id,
                    'message' => "Este es el tuit número $i de {$user->name}",
                ]);
            }
        }
    }
}
