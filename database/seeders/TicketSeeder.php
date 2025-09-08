<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_by = [1, 2, 3, 4, 5, 6];
        $assigned_to = [3, 1, 2, null, null, 5];
        $title = ['Test 1', 'Test 2', 'Test 3', 'Test 4', 'Test 5', 'Test 6'];
        $description = ['Description 1', 'Description 2', 'Description 3', 'Description 4', 'Description 5', 'Description 6'];
        $status = ['open', 'open', 'open', 'open', 'open', 'open'];
        $priority = ['low', 'medium', 'high', 'low', 'medium', 'high'];
        $project_id = [1, 2, 3, 1, 2, 3];

        for ($i = 0; $i < count($title); $i++) {
            Ticket::create([
                'created_by' => $created_by[$i],
                'assigned_to' => $assigned_to[$i],
                'title' => $title[$i],
                'description' => $description[$i],
                'status' => $status[$i],
                'priority' => $priority[$i],
                'project_id' => $project_id[$i],
            ]);
        }

    }
}
