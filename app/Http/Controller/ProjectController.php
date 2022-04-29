<?php

namespace App\Http\Controller;

use App\Models\Project;

class ProjectController
{
    protected $id = 1;

    public function index()
    {
        $project = Project::all();
        return json_encode($project->all());
    }

    public function show()
    {
        $project = Project::find($id);
        return json_encode($project);
    }
}
