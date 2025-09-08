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
        $name = ['Admin 1', 'Agent 1', 'User 1', 'Admin 2', 'Agent 2', 'User 2'];
        $email = ['admin1@admin.com', 'agent1@agent.com', 'user1@user.com', 'admin2@admin.com', 'agent2@agent.com', 'user2@user.com'];
        $password = ['123456789', '123456789', '123456789', '123456789', '123456789', '123456789'];
        $role = ['admin', 'agent', 'user', 'admin', 'agent', 'user'];
        $created_by = [1, 1, 1, 4, 4, 4];

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
