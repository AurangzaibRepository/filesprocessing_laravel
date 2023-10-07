<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Models\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private File $file,
    ) {
    }

    public function index(): view
    {
        $listing = $this->file->getList();

        return view('home.index', [
            'data' => $listing,
        ]);
    }

    public function upload(FileUploadRequest $request): RedirectResponse
    {
        $this->file->saveRecord($request);

        return to_route('home');
    }
}
