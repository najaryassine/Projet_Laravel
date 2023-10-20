<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Pagination\LengthAwarePaginator;
use PDF;


class ComplaintController extends Controller
{



    public function index(Request $request): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $sort = $request->input('sort', 'id'); // Get the sorting preference or default to sorting by ID
        $order = $request->input('order', 'asc'); // Get the sorting order or default to ascending
        $search = $request->input('search'); // Get the search query

        $query = Complaint::orderBy($sort, $order);

        // Check if there's a search query
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('subject', 'like', "%$search%")
                    ->orWhere('submission_date', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%")
                    ->orWhere('priority', 'like', "%$search%");
            });
        }

        $complaints = $query->paginate(4);

        return view('frontoffice.freelancers.complaints.index', compact('complaints', 'sort', 'order'));
    }




    public function create(): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('frontoffice.freelancers.complaints.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'subject' => 'required|string',
            'description' => 'required|string',
            'submission_date' => 'required|date',
            'status' => 'required|string',
            'priority' => 'required|string',
        ]);




        $complaint = new Complaint([
            'subject' => $request->input('subject'),
            'description' => $request->input('description'),
            'submission_date' => now(),
            'status' => 'Non Treated', // Set the default value here
            'priority' => $request->input('priority'),
            'user_id' => auth()->user()->id,



        ]);
        $complaint->save();


        return redirect()->route('frontoffice.freelancers.complaints.index')->with('success', 'Complaint added!');
    }

    public function show(Complaint $complaint): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('frontoffice.freelancers.complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('frontoffice.freelancers.complaints.edit', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint): RedirectResponse
    {

        // Check if the complaint status is not "Treated"
        if ($complaint->status !== 'Treated') {
            $request->validate([
                'subject' => 'required|string',
                'description' => 'required|string',
            ]);

            $complaint->update([
                'subject' => $request->input('subject'),
                'description' => $request->input('description'),
            ]);

            return redirect()->route('frontoffice.freelancers.complaints.show', $complaint->id)->with('success', 'Complaint updated successfully!');
        }

        // If status is "Treated," redirect back or show an error message
        return redirect()->back()->with('error', 'Cannot edit a "Treated" complaint.');

    }

    public function destroy(Complaint $complaint): RedirectResponse
    {
        $complaint->delete();

        return redirect()->route('frontoffice.freelancers.complaints.index')->with('success', 'Réclamation supprimée avec succès!');
    }



    public function generatePDF(Complaint $complaint)
    {
        $data = ['complaint' => $complaint];

        unset($data['complaint']->created_at);
        unset($data['complaint']->updated_at);

        $pdf = PDF::loadView('frontoffice.freelancers.complaints.pdf', $data);

        return $pdf->download($complaint->subject . '.pdf');
    }



}
