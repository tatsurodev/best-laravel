<?php

use App\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'contacts@tatsuro.dev')->first();
        if (!$user) {
            User::create([
                'name' => 'Tatsuro',
                'email' => 'contacts@tatsuro.dev',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }
    }
}
