<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['Admin', 'Agent', 'User'];
        $email = ['admin@admin.com', 'agent@agent.com', 'user@user.com'];
        $password = ['123456789', '123456789', '123456789'];
        $role = ['admin', 'agent', 'user'];
        $created_by = [1, 1, 1];

        for ($i = 0; $i < count($name); $i++) {
            User::create([
                'name' => $name[$i],
                'email' => $email[$i],
                'password' => $password[$i],
                'role' => $role[$i],
                'created_by' => $created_by[$i],
                'email_verified_at' => now(),
            ]);
        }
    }
}
