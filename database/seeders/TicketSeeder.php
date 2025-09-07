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
        $created_by = [1, 2, 3];
        $assigned_to = [3, 1, 2];
        $title = ['Test1', 'Test2', 'Test3'];
        $description = ['Description1', 'Description2', 'Description3'];
        $status = ['open', 'closed', 'open'];
        $priority = ['low', 'medium', 'high'];
        $project_id = [1, 2, 3];

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
