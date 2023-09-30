<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('frontoffice.freelancers.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontoffice.clients.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'cost' => 'numeric',
            'required_skills' => 'required|string',
            'category' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $uploadedImage = $request->file('image');
            $imageName = $uploadedImage->getClientOriginalName();
            $imagePath = $uploadedImage->storeAs('public/assets/img', $imageName);
            $validatedData['image'] = $imageName;
        }

        $validatedData['client_id'] = auth()->user()->id;
        $project = Project::create($validatedData);

        
        return redirect('/client')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
            'client_id' => 'exists:users,id',
            'cost' => 'numeric',
            'status' => 'in:not completed,completed',
            'required_skills' => 'array',
            'category' => 'string',
        ]);

        $project = Project::find($id);
        $project->update($validatedData);

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}