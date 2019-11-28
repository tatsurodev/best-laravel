<?php

use Illuminate\Database\Seeder;
use LaravelForum\User;
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
        User::create([
            'name' => 'Tatsuro',
            'email' => 'contacts@tatsuro.dev',
            'password' => Hash::make('epsilon9'),
        ]);
        factory(User::class, 10)->create();
    }
}
