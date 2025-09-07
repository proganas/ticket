<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_by = [1, 1, 1];
        $name = ['Project 1', 'Project 2', 'Project 3'];
        $description = ['Description 1', 'Description 2', 'Description 3'];

        for ($i = 0; $i < count($name); $i++) {
            Project::create([
                'created_by' => $created_by[$i],
                'name' => $name[$i],
                'description' => $description[$i],
            ]);
        }

    }
}
