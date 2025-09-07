<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        try {
            $projects = Project::paginate(10);
            return view('projects.index', compact('projects'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['error' => 'Something Wrong']);
        }
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(ProjectRequest $request)
    {
        try {
            $requested_data = $request->only(['name', 'description', 'created_by']);
            Project::create($requested_data);

            return redirect()->route("admin.projects.index")->with('success', 'Project created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['error' => 'Something Wrong']);
        }
    }

    public function edit($id)
    {
        try {
            $project = Project::findOrFail($id);
            return view('projects.edit', compact('project'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['error' => 'Something Wrong']);
        }
    }

    public function update(ProjectRequest $request, $id)
    {
        try {
            $ticket = Project::findOrFail($id);
            $requested_data = $request->only(['name', 'description', 'created_by']);
            $ticket->update($requested_data);

            return redirect()->route("admin.projects.index")->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['error' => 'Something Wrong']);
        }
    }

    public function destroy($id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->delete();

            return redirect()->route("admin.projects.index")->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Something Wrong']);
        }
    }
}
