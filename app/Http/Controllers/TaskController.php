<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\project;
use App\Models\contract;

class TaskController extends Controller
{
    public function index()
    {
        // Récupérer toutes les tâches à partir du modèle Task
        $tasks = Task::all();

        // Passer les tâches à une vue pour les afficher
        return view('frontoffice.tasks.index', compact('tasks'));
    }

    public function create($projectId)
    {
        // Récupérez les contrats associés au projet
        $contracts = Contract::where('project_id', $projectId)->get();
    
        // Récupérez les freelancers liés à ces contrats
        $freelancers = $contracts->map(function ($contract) {
            return $contract->freelancer;
        });
    
        // Affichez le formulaire de création de tâche en passant les freelancers
        return view('frontoffice.tasks.create', compact('freelancers', 'projectId'));
    }
    


    public function store(Request $request)
{
    // Validez les données du formulaire
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date' => 'nullable|date',
        'project_id' => 'required|exists:projects,id',
        'assigned_to' => 'required|exists:users,id'
    ]);

    // Set the default status if it's not provided in the request
    $validatedData['status'] = $request->input('status', 'not completed');

    // Créez une nouvelle tâche avec les données validées
    Task::create($validatedData);

    // Redirigez vers une page de confirmation ou une autre action
    return redirect()->route('frontoffice.tasks.index');
}

    

    
    public function show($id)
{
    // Récupérer la tâche correspondante en fonction de l'ID
    $task = Task::findOrFail($id);

    // Passer la tâche à une vue pour l'afficher
    return view('frontoffice.tasks.show', compact('task'));
}
public function edit($id)
{
    // Récupérer la tâche correspondante en fonction de l'ID
    $task = Task::findOrFail($id);

    // Passer la tâche à une vue pour le formulaire de modification
    return view('frontoffice.tasks.edit', compact('task'));
}


public function update(Request $request, $id)
{
    // Valider les données du formulaire
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date' => 'nullable|date',
        'status' => 'nullable|string',
    ]);

    
        // Assigner l'ID de l'utilisateur connecté au champ assigned_to
        $validatedData['assigned_to'] = auth()->user()->id;

    // Mettre à jour la tâche en fonction de l'ID
    Task::where('id', $id)->update($validatedData);

    // Rediriger vers une page de confirmation ou une autre action
    return redirect()->route('frontoffice.tasks.show', ['id' => $id]);
}

public function destroy($id)
{
    // Supprimer la tâche en fonction de l'ID
    Task::findOrFail($id)->delete();

    // Rediriger vers une page de confirmation ou une autre action
    return redirect()->route('frontoffice.tasks.index');
}



public function tasksAssignedToUser()
{
    // Get the logged-in user
    $user = auth()->user();

    // Check if the user has the 'freelancer' role
    if ($user->role === 2) {
        // Retrieve the tasks assigned to the freelancer
        $tasks = $user->assignedTasks;
        
        // Pass the tasks to a view
        return view('frontoffice.tasks.index', ['tasks' => $tasks]);
    }

    return view('frontoffice.tasks.index'); // Return a view without tasks if the user is not a freelancer
}


}
