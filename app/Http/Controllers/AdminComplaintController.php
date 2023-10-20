<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Pagination\LengthAwarePaginator;


class AdminComplaintController extends Controller
{


    public function index(Request $request): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {


        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');
        $search = $request->input('search'); // Get the search query

        $query = Complaint::orderBy($sort, $order);

        if ($search) {
            // Add a WHERE clause to filter results based on the search query
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%$search%");
                $q->orWhere('description', 'like', "%$search%");
                // Add more fields as needed
            });
        }

        $complaints = $query->paginate(4);

        return view('backoffice.complaints.index', compact('complaints', 'sort', 'order'));


    }




    public function show(Complaint $complaint): Factory|View|Application
    {
        return view('backoffice.complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint): Factory|View|Application
    {
        return view('backoffice.complaints.edit', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint): RedirectResponse
    {
        $request->validate([
            'subject' => 'required|string',
            'description' => 'required|string',
            'submission_date' => 'required|date',
            'status' => 'required|string',
            'priority' => 'required|string',
        ]);

        $complaint->update($request->all());

        return redirect()->route('backoffice.complaints.index')->with('success', 'Complaint updated successfully!');
    }

    public function destroy(Complaint $complaint): RedirectResponse
    {
        $complaint->delete();

        return redirect()->route('backoffice.complaints.index')->with('success', 'Complaint deleted successfully!');
    }
}
