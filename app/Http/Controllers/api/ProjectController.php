<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        
        $projects = Project::with('technologies', 'type')->paginate(10);
        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
        
    }

    public function show(Project $project) {
        // $projects = Project::with('technologies', 'type')->paginate(10);
        return response()->json([
            'success' => true,
            'results' => $project
        ]);
    }
}