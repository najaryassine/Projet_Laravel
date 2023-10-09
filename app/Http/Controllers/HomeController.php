<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }

    public function home1()
    {
        return view('frontoffice.home1');
    }

    public function home2()
    {
        return view('frontoffice.home2');
    }
}
