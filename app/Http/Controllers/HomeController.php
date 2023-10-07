<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\FileUploadRequest;

class HomeController extends Controller
{
    public function index(): view
    {
        return view("home.index");
    }

    public function upload(FileUploadRequest $request): RedirectResponse
    {
        return to_route('home');
    }
}
