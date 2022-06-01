<?php

namespace App\Http\Controller;

use Framework\Request\Request;
use App\Models\Project;

class ProjectController
{
    protected $id = 1;

    public function index()
    {
        $project = Project::all();
        return json_encode($project->all());
    }

    public function show($id)
    {
        $project = Project::findWithId($id)->get();
        return json_encode($project);
    }

    public function store(Request $request)
    {
        $title = $request->title;
        $desc = $request->description;
        
        $project = save([
            'title' => $title,
            'description' => $title 
        ]);

        return json_encode($project);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findWithId($id)->get();
        $project->title = $request->title;
        $project->desc = $request->description;
        
        $project = update([
            'title' => $title,
            'description' => $title 
        ]);

        return json_encode($project);
    }

    public function destroy($id)
    {
        $project = Project::findWithId($id)->get();
        $project->delete;

        return json_encode('Project deleted');
    }

}
