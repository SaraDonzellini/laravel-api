<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use League\Flysystem\StorageAttributes;

class ProjectController extends Controller
{
    public function GetValidated($request){
        return $request->validate([
            'title' => 'required|string|min:2|max:50',
            'author' => 'required|string|min:2|max:50',
            'image' => 'required|image|max:350',
            'content' => 'required|min:10',
            'date' => 'required|string|min:2|max:20',
            'type_id' => 'required|exists:types,id',
            'technologies' => 'array'
        ]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view('admin.projects.index', compact('projects'), 
        // ['projects' => DB::table('projects')->paginate(15)]
    );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('admin.projects.create', compact('project'), ['types' => Type::all(), 'technologies' => Technology::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->GetValidated($request);
        
        $data = $request->all();
        $newProject = new Project();

        $data['author'] = Auth::user()->name;
        $data['slug'] = Str::slug($newProject['title']);
        $data['image'] = Storage::put('uploads', $data['image']);
        $newProject->fill($data);
        $newProject->save();
        if (isset($data['technologies'])) {
            $newProject->technologies()->sync($data['technologies']);
        };
        

        return redirect()->route('admin.projects.show', $newProject->id)->with('message', "$newProject->title has been created")->with('alert-type', 'info');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'), ['types' => Type::all(), 'technologies' => Technology::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->GetValidated($request);
        
        if ($request->hasFile('image')) {
            
            if (!str_starts_with($project->image, 'http')){
                Storage::delete($project->image);
            }

            $data['image'] = Storage::put('uploads', $data['image']);
        }

        
        $data = $request->all();
        $newProject = new Project();

        $data['author'] = Auth::user()->name;
        $data['slug'] = Str::slug($newProject['title']);

        $newProject->fill($data);
        $newProject->save();
        if (isset($data['technologies'])) {
            $newProject->technologies()->sync($data['technologies']);
        };

        return redirect()->route('admin.projects.show', $newProject->id)->with('message', "$newProject->title has been modified")->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if (!str_starts_with($project->image, 'http')) {
            Storage::delete($project->image);
        }

        $project->technologies()->sync([]);
        $project->delete();
        
        return redirect()->route('admin.projects.index', compact('project'))->with('message', "$project->title has been deleted")->with('alert-type', 'danger');
    }
}