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
        User::create([
            'name' => 'Monty',
            'email' => 'montyhollings@mailbox.org',
            'password' => bcrypt(env('user_password')),
        ]);

        $user = User::first();
        $user->assignRole('administrator');

    }
}
