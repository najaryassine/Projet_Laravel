<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PortfolioController extends Controller
{

    public function index(): View
    {
        $portfolios = Portfolio::all();
        return view('frontoffice.freelancers.portfolios.index', compact('portfolios'));
    }

    public function create(): View
    {
        $freelancer = Auth::user();

        $freelancerId = $freelancer->id;
        return view('frontoffice.freelancers.portfolios.create' , compact('freelancerId'));
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'nullable|date',
            'technologies' => 'nullable|string',
            'client' => 'nullable|string',
            'statut' => 'nullable|string',
        ]);

        $portfolio = new Portfolio([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'technologies' => $request->input('technologies'),
            'client' => $request->input('client'),
            'statut' => $request->input('statut'),
            'freelancer_id' => auth()->user()->id,
        ]);

        $portfolio->save();

        return redirect()->route('frontoffice.freelancers.portfolios.index')->with('success', 'Portfolio added!');
    }

    public function show(Portfolio $portfolio): View
    {
        return view('frontoffice.freelancers.portfolios.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio): View
    {
        return view('frontoffice.freelancers.portfolios.edit', compact('portfolio'));
    }



    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'nullable|date',
            'technologies' => 'nullable|string',
            'client' => 'nullable|string',
            'statut' => 'nullable|string',
        ]);

        // Check if the authenticated user owns the portfolio
        if (auth()->user()->id == $portfolio->freelancer_id) {
            $portfolio->update([
                'titre' => $request->input('titre'),
                'description' => $request->input('description'),
                'date' => $request->input('date'),
                'technologies' => $request->input('technologies'),
                'client' => $request->input('client'),
                'statut' => $request->input('statut'),
            ]);

            return redirect()->route('frontoffice.freelancers.portfolios.index')
                ->with('success', 'Portfolio updated successfully!');
        }

        return redirect()->route('frontoffice.freelancers.portfolios.index')
            ->with('error', 'You do not have permission to update this portfolio.');
    }




    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $portfolio->delete();
        return redirect()->route('frontoffice.freelancers.portfolios.index')->with('success', 'portfolios supprimé avec succès!');
    }

}
