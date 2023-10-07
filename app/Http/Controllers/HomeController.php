<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): view
    {
        return view("home.index");
    }

    public function upload(): RedirectResponse
    {
        return to_route('home');
    }
}
