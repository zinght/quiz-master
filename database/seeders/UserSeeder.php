<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Monty",
            'email' => "montyhollings@mailbox.org",
            'password' => Hash::make(env('user_password')),
        ]);
        $user = User::first();
        $user->assignRole('administrator');

    }
}
