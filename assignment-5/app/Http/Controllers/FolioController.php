<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;

class FolioController extends Controller
{
    public function index()
    {
        $profile = File::json(storage_path("data/profile.json"));

        return view("home", compact("profile"));
    }

    public function experiences()
    {
        $experiences = File::json(storage_path("data/experiences.json"));

        return view("experiences", compact("experiences"));
    }

    public function projects()
    {
        $projects = File::json(storage_path("data/projects.json"));

        return view("projects", compact("projects"));
    }

    public function project(string $projectId)
    {
        $projects = File::json(storage_path("data/projects.json"));

        if(!Arr::exists($projects, ($projectId - "1"))) {
            abort(404);
        }

        $project = $projects[$projectId - "1"];

        return view("project", compact("project"));
    }
}
