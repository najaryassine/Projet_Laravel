<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Project;

class   ReviewController extends Controller
{
/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function index()
     {
         $reviews = Review::orderBy('created_at', 'desc')->get();
     
         return view('index', compact('reviews'));
     }


public function destroy($id)
{
    // Find the review by its ID
    $review = Review::find($id);

    // Check if the review exists
    if (!$review) {
        return redirect()->route('projects.index1')->with('error', 'Review not found.');
    }

    // Delete the review
    $review->delete();

    return redirect()->route('showForm')->with('success', 'Review deleted successfully.');
}

public function update(Request $request, $id)
{
    // Find the review by its ID
    $review = Review::find($id);

    // Check if the review exists
    if (!$review) {
        return redirect()->route('index')->with('error', 'Review not found.');
    }

    // Validate the request data
    $validatedData = $request->validate([
        'review' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    // Update the review with the new data
    $review->rating = $request->rating;
    $review->review = $request->review;
    $review->save();

    return redirect()->route('showForm')->with('success', 'Review updated successfully.');
}






     public function store(Request $request)
     {
         // Validate the request data
         $validatedData = $request->validate([
             'review' => 'required|string',
             'rating' => 'required|integer|min:1|max:5',
         ]);
     
         // Create a new review instance
         $review = new Review();
         $review->rating = $request->rating;
         $review->review = $request->review;
         $review->user_id = auth()->id();
     
         
     
         // Save the review to the database
         $review->save();
     
         return redirect()->route('showForm');
     }


    // public function store(Request $request)
    // {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'review' => 'required|string',
    //         'rating' => 'required|integer|min:1|max:5',
    //         'project_id' => 'required|integer', // Add this validation rule
    //          // Add this validation rule
    //     ]);

    //     // Create a new review instance
    //     $review = new Review();
    //     $review->rating = $request->rating;
    //     $review->review = $request->review;
    //     $review->project_id = $request->project_id; // Associate the review with the project
    //     $review->user_id = $request->user_id; // Associate the review with the user

    //     $review->user_id = auth()->id();
    //     // Save the review to the database
    //     $review->save();

    //     return redirect()->route('index');
    // }
        

// public function store(){
//         var_dump("hello");

// }

public function showForm()
{

    // // Retrieve the project based on the $projectId
    // $project = Project::find($projectId);

    

    $reviews = Review::orderBy('created_at', 'desc')->get();
    // You can pass any data you need to the view here
    return view('frontoffice.Review.rate_review', compact('reviews'));

}

public function show($id)
{

    // // Retrieve the project based on the $projectId
    // $project = Project::find($projectId);

    $review = Review::find($id);

    // You can pass any data you need to the view here
    return view('frontoffice.Review.show', compact('review'));

}

}
