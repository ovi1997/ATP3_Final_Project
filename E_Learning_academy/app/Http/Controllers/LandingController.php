<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function contactUs()
    {
        return view('contactUs');
    }

    public function aboutUs()
    {
        return view('aboutUs');
    }

    public function courses()
    {
        return view('courses');
    }
}
