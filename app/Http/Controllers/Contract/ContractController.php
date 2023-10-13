<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\User;
use App\Models\Project;


class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
        $contracts = Contract::paginate(5);
        return view('contract-management', compact('contracts'));
    }

     /**
     * apply for contract.
     *
     * @return \Illuminate\Http\Response
     */
    public function apply($userId, $projectId, $cost, $clientId)
    {        
        Contract::create([ 'freelancer_id' => $userId,'project_id' => $projectId,'project_cost' => $cost,
        'client_id' => $clientId,'status' => 'pending']);
        return redirect('projects')->with('success', 'Contract application submitted successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create1()
    {
        $users = User::all();
        $projects = Project::all();


        return view('contracts.addContract', compact('users','projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            'project_id' => 'required',
            'client_id' => 'required',
            'freelancer_id' => 'required',
            'project_cost' => 'required',
        ]);

        $contract = Contract::create($validatedData);
        
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit1($id)
    {
        $projects = Project::all();
        $contract = Contract::find($id);
        $users = User::all();

        return view('contracts.updateContract', compact('contract','users','projects'));
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
            'project_id' => 'required',
            'client_id' => 'required',
            'freelancer_id' => 'required',
            'project_cost' => 'required',
        ]);
        $contract = Contract::find($id);
        $contract->update($validatedData);
        return redirect('/contracts-management')->with('success', 'Contract created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy1($id)
    {
        $contract = Contract::find($id);
        $contract->delete();

        return redirect()->route('contracts-management')
            ->with('success', 'Contract deleted successfully.');
    }
}
