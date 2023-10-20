<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\PusherBroadcast;
use App\Models\User;

class   PusherController extends Controller
{
/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index1($id)
     
      { 
        $user = User::find($id);

         return view('index1' ,compact('user'));
      }


    public function broadcast(Request $request)
        {
            // $client = new \GuzzleHttp\Client([
            //     'verify' => false, // Disable SSL certificate verification (not recommended for production)
            // ]);
        
            $message = $request->get('message');

            if ($message !== null) {
                broadcast(new PusherBroadcast($message))->toOthers();
                return view('broadcast', ['message' => $message]);
            } else {
                // Handle the case where the message is null
                return redirect()->back()->with('error', 'Message cannot be null');
            }
        }

    public function receive(Request $request)
        {
            
            return view('receive', ['message' => $request->get('message')]);
        }

    


}
