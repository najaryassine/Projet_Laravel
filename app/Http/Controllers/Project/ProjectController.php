<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;




class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $selectedCategory = $request->input('category');
    
        $query = Project::query();
    
        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }
    
        $projects = $query->paginate(4); 

        $appliedContracts = Contract::where('freelancer_id', Auth::user()->id);
    
        return view('frontoffice.freelancers.projects.index', compact('projects', 'appliedContracts'));    
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $selectedCategory = $request->input('category');

        $query = Project::where('client_id', Auth::user()->id);

        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }
    
        $projects = $query->paginate(4); 
    
        return view('frontoffice.clients.projects.created', compact('projects'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
        $projects = Project::paginate(5);
        return view('project-management', compact('projects'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create1()
    {
        $users = User::all();

        return view('projects.addProject', compact('users'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store1(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'client_id' => 'required',
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

        $project = Project::create($validatedData);
        
        return redirect('/project-management')->with('success', 'Project created successfully.');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show1($id)
    {
    $project = Project::find($id);

    if (!$project) {
        abort(404); 
    }
    $appliedContracts = Contract::where('freelancer_id', Auth::user()->id);

    return view('frontoffice.freelancers.projects.show', compact('project','appliedContracts'));
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
        return view('frontoffice.clients.projects.updateProject', compact('project'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit1($id)
    {
        $project = Project::find($id);
        $users = User::all();
        return view('projects.updateProject', compact('project','users'));

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
            'cost' => 'numeric',
            'category' => 'string',
        ]);

        if ($request->hasFile('image')) {
            $uploadedImage = $request->file('image');
            $imageFileName = $uploadedImage->getClientOriginalName();
            $imagePath = $uploadedImage->storeAs('public/assets/img', $imageFileName);
            $image = $imageFileName;
    
            Project::where('id', $id)
                ->update(['image' => $image]);
        }

        $project = Project::find($id);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->cost = $request->cost;
        $project->category = $request->category;
        $project->save();

        return redirect()->route('projects.list1')
            ->with('success', 'Project updated successfully.');
    }

/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update1(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
            'client_id' => 'exists:users,id',
            'cost' => 'numeric',
            'status' => 'in:not completed,completed',
            'required_skills' => 'required',
            'category' => 'string',
        ]);

        $project = Project::find($id);
        $project->update($validatedData);

        return redirect()->route('project-management')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy0($id)
    {
        $project = Project::find($id);
        $project->delete();

        return redirect()->route('projects.list1')
            ->with('success', 'Project deleted successfully.');
    }


      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy1($id)
    {
        $project = Project::find($id);
        $project->delete();

        return redirect()->route('project-management')
            ->with('success', 'Project deleted successfully.');
    }

}