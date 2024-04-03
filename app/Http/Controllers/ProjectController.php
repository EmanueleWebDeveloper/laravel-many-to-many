<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Type;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\returnSelf;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = Project::all();

        return view('pages.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //ottengo i dati della tabella type
        $types = Type::all();

        return view('pages.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated_data = $request->validated();

        $slug = Project::generateSlug($request->title);
        $validated_data['slug'] = $slug;


        //gestione immagine
        if( $request->hasFile('cover') ){

            $path = Storage::disk('public')->put( 'project_images', $request->cover );


            $validated_data['cover'] = $path;
            // dd($validated_data, $path);
        }

        $new_project = Project::create($validated_data);

        return redirect()->route('dashboard.project.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('pages.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        return view('pages.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateProjectRequest $request, Project $project)
    {

        $validated_data = $request->validated();

        $slug = Project::generateSlug($request->title);
        $validated_data['slug'] = $slug;

        if($array['cover'] ?? false){
            if($project->cover){
              $checkdelete=Storage::delete($project->cover);
              if(!$checkdelete){
                dd($project->cover,'non sono riuscito a cancellare');
              }
            }

            $path = Storage::put('project_images', $validated_data['cover']);

            $validated_data['cover'] = $path;
        }

        $project->update($validated_data);
        return redirect()->route('dashboard.project.show', ['project' => $project]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if($project->cover){
            Storage::delete($project->cover);
        }

        $project->delete();
        return redirect()->route('dashboard.project.index');
    }
}
